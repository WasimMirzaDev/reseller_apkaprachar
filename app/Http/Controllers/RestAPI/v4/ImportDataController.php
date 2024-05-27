<?php

namespace App\Http\Controllers\RestAPI\v4;

use Illuminate\Database\QueryException;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;

class ImportDataController extends Controller
{
  
    public function importData(Request $request)
    {
        try {
            // Extract the product data from the request
            $productData = $request->input('product_data');

            // Begin a database transaction
            DB::beginTransaction();

            // Check if the product already exists based on a unique identifier (e.g., product name)
            $existingProduct = Product::where('main_product_id', $productData['id'])->first();

            // Handle existing product
            if ($existingProduct) {
                $msg = $this->handleExistingProduct($productData, $existingProduct);

                DB::commit();
                return response()->json(['message' => $msg], 400);
            }

            // If the product does not exist, continue with the regular import process
            $msg = $this->createProduct($productData);

            // Commit the transaction
            DB::commit();

            // Return success response
            return response()->json(['message' => $msg], 200);
        } catch (QueryException $e) {
            // Something went wrong with database queries, rollback the transaction and return an error response
            DB::rollBack();
            return response()->json(['message' => 'Failed to import product. Error: ' . $e->getMessage()], 500);
        } catch (Exception $e) {
            // Catch any other exceptions and return an error response
            return response()->json(['message' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }

    private function handleExistingProduct($productData, $existingProduct)
    {
        try {
            unset($productData['reviews']['translations']);
            $msg = 'Product already imported';
            
            // Check for existing reviews
            $existingReviewIds = $this->getExistingReviewIds($productData['reviews'], $existingProduct->id);

            // Filter out existing reviews
            $newReviews = $this->filterNewReviews($productData['reviews'], $existingReviewIds);

            if (!empty($newReviews)) {
                $this->saveNewReviews($newReviews, $existingProduct->id);
                $msg = 'Product already imported but new reviews added successfully';
            }

            return $msg;
        } catch (Exception $e) {
            // Catch any exceptions and rethrow them to be caught in the main function
            throw $e;
        }
    }

    private function getExistingReviewIds($reviews, $productId)
    {
        try {
            return Review::whereIn('customer_id', array_column($reviews, 'customer_id'))
                ->where('product_id', $productId)
                ->pluck('customer_id')
                ->toArray();
        } catch (Exception $e) {
            // Catch any exceptions and rethrow them to be caught in the calling function
            throw $e;
        }
    }

    private function filterNewReviews($reviews, $existingReviewIds)
    {
        try {
            return array_filter($reviews, function ($review) use ($existingReviewIds) {
                return !in_array($review['customer_id'], $existingReviewIds);
            });
        } catch (Exception $e) {
            // Catch any exceptions and rethrow them to be caught in the calling function
            throw $e;
        }
    }

    private function saveNewReviews($newReviews, $productId)
    {
        try {
            foreach ($newReviews as $reviewData) {
                $review = new Review();
                $review->fill($reviewData);
                $review->product_id = $productId;
                $review->saveQuietly();

                $existingCustomer = User::where('email', $reviewData['customer']['email'])->first();

                if (!$existingCustomer) {
                    // If customer doesn't exist, create a new one
                    $customer = new User();
                    $customer->fill($reviewData['customer']);
                    $customer->save();
                }
            }
        } catch (Exception $e) {
            // Catch any exceptions and rethrow them to be caught in the calling function
            throw $e;
        }
    }

    private function createProduct($productData)
    {
        try {
            // Remove translation column from models
            unset($productData['translations']);
            unset($productData['brand']['translations']);
            unset($productData['category']['translations']);
            unset($productData['reviews']['translations']);

            // Find or create the brand based on its data
            $brand = Brand::firstOrCreate(['name' => $productData['brand']['name']]);

            // Find or create the category based on its data
            $category = Category::firstOrCreate(['name' => $productData['category']['name']]);
            
            // Create the product with relationships
            $product = new Product();
            $product->fill($productData);
            $product->brand_id = $brand->id;
            $product->category_id = $category->id;
            $product->is_imported = 1;
            $product->purchase_price = $productData['unit_price'];
            $product->main_product_id = $productData['id'];

            // Save the product
            $product->saveQuietly();

            // Add reviews
            if (!empty($productData['reviews']) && is_array($productData['reviews'])) {
                foreach ($productData['reviews'] as $reviewData) {
                    // Check if review already exists for the product
                    $existingReview = Review::where('product_id', $product->id)
                        ->where('customer_id', $reviewData['customer_id'])
                        ->where('comment', $reviewData['comment'])
                        ->first();

                    if (!$existingReview) {
                        // If review doesn't exist, create a new one
                        $review = new Review();
                        $review->fill($reviewData);
                        $review->product_id = $product->id;
                        $review->saveQuietly();
                    }

                    $existingCustomer = User::where('email', $reviewData['customer']['email'])->first();
                    
                    if (!$existingCustomer) {
                        // If customer doesn't exist, create a new one
                        $customer = new User();
                        $customer->fill($reviewData['customer']);
                        $customer->save();
                    }
                }
            }
            
            return 'Product imported successfully';
        } catch (Exception $e) {
            // Catch any exceptions and rethrow them to be caught in the calling function
            throw $e;
        }
    }
    
    public function changeStatus(Request $request)
    {
        try {
            $order = $request->order;
            $updateOrder = Order::find($order['imported_order_id']);
            $updateOrder->order_status = $order['order_status'];
            $updateOrder->payment_status = $order['payment_status'];
            $updateOrder->save();
    
            if ($order['order_status'] == 'delivered' && $order['seller_id'] != null) {
                $orderDetail=OrderDetail::where('order_id',$order_id)->update(['delivery_status' => 'delivered']);
            }
            return response()->json(['message' => 'Status updated successfully'], 200);
        }catch(Exception $e){
            return response()->json(['message' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }

}