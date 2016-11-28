<?php

/**
 * @class ValidateFields
 * @brief Class of validate functions
 * @author Nidhi Agarwal
 * @date 2016-11-26
 */
class ValidateFields {

	/**
     * @fn validateCategoryDetails
     * @details validate category name abd category description
     * @param $categoryName - name of category
     * @param $categoryDesc - description of category
     * @return $errMsg - array of error messages
     */
	public function validateCategoryDetails($categoryName, $categoryDesc) {
		$errMsg = array();

		if ($this->validateBlank($categoryName)) {
			array_push($errMsg, 'Please enter a category name.');
		} 
		elseif ($this->validateMaxLength($categoryName, 50)) {
			array_push($errMsg, 'Please limit the category to 50 characters.');
		} 

		if ($this->validateBlank($categoryDesc)) {
			array_push($errMsg, 'Please enter a category description.');
		} 
		elseif ($this->validateMaxLength($categoryDesc, 250)) {
			array_push($errMsg, 'Please limit the category description to 250 characters.');
		}

		return $errMsg;
	}

	/**
     * @fn validateProductDetails
     * @details validate product details
     * @param $productDetails - array of product details
     * @subparam $product_name - name of the product
     * @subparam $product_desc - description of the product
     * @subparam $price - product price
     * @subparam $tax - tax incurred on the product
     * @subparam $discount - discount incurred on the product
     * @return $errMsg - array of error messages
     */
	public function validateProductDetails($productDetails) {
		extract($productDetails);
		$errMsg = array();

		if ($this->validateBlank($product_name)) {
			array_push($errMsg, 'Please enter a product name.');
		} 
		elseif ($this->validateMaxLength($product_name, 50)) {
			array_push($errMsg, 'Please limit the product to 50 characters.');
		} 

		if ($this->validateBlank($product_desc)) {
			array_push($errMsg, 'Please enter a product description.');
		} 
		elseif ($this->validateMaxLength($product_desc, 250)) {
			array_push($errMsg, 'Please limit the product description to 250 characters.');
		}

		if (!is_numeric($price) || $price == 0) {
			array_push($errMsg, 'Please enter a valid price of the product.');
		}
		 
		if (!is_numeric($tax)) {
			array_push($errMsg, 'Please enter a valid tax incurred on this product.');
		}

		if (!is_numeric($discount)) {
			array_push($errMsg, 'Please enter a valid discount incurred on this product.');
		}

		return $errMsg;
	}

	/**
     * @fn validateBlank
     * @details check if the value has been left blank
     * @param $value - value to be checked
     * @return true - value is blank
     */
	private function validateBlank($value = '') {
		$value = trim($value);
		$value = stripslashes($value);
		$value = htmlspecialchars($value);
		if(empty($value)) {
			return true; //error
		}
	}

	/**
     * @fn validateMaxLength
     * @details check if the max length of the value has not been exceeded
     * @param $value - value to be checked
     * @param $length - max length of the value
     * @return true - length exceeds the specified limit
     */
	private function validateMaxLength($value = '', $length = 50) {
		$value = trim($value);

		if (strlen($value) > $length) {
			return true; //error
		}
	}
}