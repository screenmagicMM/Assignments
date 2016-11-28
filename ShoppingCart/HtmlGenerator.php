<?php

/**
 * @class HtmlGenerator
 * @brief class to create html elements
 * @author Nidhi Agarwal
 * @date 2016-11-26
 */
class HtmlGenerator {

	/**
     * @fn createCategoryBox
     * @details Creates a drop down of categories
     * @param $arrCategory - array of categories
     * @return dropdown
     */
	static function createCategoryBox($arrCategory) {
		$selectBox = '<select name="category_name">';

		foreach ($arrCategory as $details) {
	
  			$selectBox .= "<option value=". $details[category_id]. ">". $details[category_name] ."</option>";
		}

    		$selectBox .= '</select>';

		return $selectBox;
	}

	/**
     * @fn createProductBox
     * @details Creates a drop down of products
     * @param $arrProduct - array of products
     * @return dropdown
     */
	static function createProductBox($arrProduct) {
		$selectBox = '<select name="product">';

		foreach ($arrProduct as $details) {
	
  			$selectBox .= "<option value=". $details[product_id]. ">". $details[product_name] ."</option>";
		}

    		$selectBox .= '</select>';


		return $selectBox;
	}

	/**
     * @fn createCategoryList
     * @details Creates a list of categories
     * @param $arrCategories - array of categories
     * @return list
     */
	static function createCategoryList($arrCategories) {
		$categoryList = '<div class="header-row row">
							<span class="cell primary">Category Name</span>
							<span class="cell">Category Description</span>
						</div>
						';
		foreach($arrCategories as $categoryDetail) {
			$categoryList .= '<div class="row">
								<span class="cell primary" data-label="Category Name">'. $categoryDetail['category_name'].'</span>
								<span class="cell" data-label="Category Description">'.$categoryDetail['category_desc'].'</span>
							</div>';
		}
		return $categoryList.'';
	}

	/**
     * @fn createCart
     * @details Creates a list of all the cart items
     * @param $arrCart - array of cart items
     * @return list
     */
	static function createCart($arrCart) {
		
		$table = '<div class="row header-row">
					
					<span class="cell primary">Product</span>
					<span class="cell">Quantity</span>
					<span class="cell">Total Price</span>
					<span class="cell">Discount</span>
					<span class="cell">Tax</span>
					<span class="cell">Total with Discount</span>
					<span class="cell">Total With Tax</span>
				</div>
				';

		foreach($arrCart as $cartDetail) {

			$total_with_discount = $cartDetail['total_price'] - $cartDetail['discount'];
			$total_with_tax = $total_with_discount + $cartDetail['tax'];

			$user = $cartDetail['cart_name'];

			$table .= '<div class="row">
								<span class="cell primary" data-label="Product">'.$cartDetail['product'].'</span>
								<span class="cell" data-label="Quantity">'.$cartDetail['quantity'].'</span>
								<span class="cell" data-label="Total Price">'.$cartDetail['total_price'].'</span>
								<span class="cell" data-label="Discount">'.$cartDetail['discount'].'</span>
								<span class="cell" data-label="Tax">'.$cartDetail['tax'].'</span>
								<span class="cell" data-label="Total with Discount">'.$total_with_discount.'</span>
								<span class="cell" data-label="Total With Tax">'.$total_with_tax.'</span>
							</div>';
			
        	$grand_total += $total_with_tax;
		}

		$cart .= '<span class="total">Cart Name: </span><span>'.$user.'</span>'.$table.'<div class="total"><span>Grand Total</span><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $grand_total . '</span></div>';
		return $cart;
	}

	/**
     * @fn createErrorList
     * @details Creates list of errors
     * @param $arrErrors - array of categories
     */
	static function createErrorList($arrErrors) {
		foreach ($arrErrors as $error) {
  			$errorList .= "<div  class='error'>". $error ."</div>";
		}

		return $errorList;
	}

	/**
     * @fn createSuccessMessage
     * @details Creates success message
     * @param $successMessage
     */
	static function createSuccessMessage($successMessage) {
		
  		$formattedMessage .= "<div class='success'>". $successMessage ."</div>";
		

		return $formattedMessage;
	}
}


