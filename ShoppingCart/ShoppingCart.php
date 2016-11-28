<?php

spl_autoload_register(function($class) {
    include $class . '.php';
});

/**
 * @class ShoppingCart
 * @brief Class of all RESTful API calls
 * @author Nidhi Agarwal
 * @date 2016-11-26
 */
class ShoppingCart {
	private $objCategoryStore;
	private $objProductStore;
	private $objCartStore;

	/**
     * @fn __construct
     * @brief Constructor function
     * @details Makes objects of all table stores
     */
	public function __construct() {
		$this->objCategoryStore = new category_store();
		$this->objProductStore = new product_store();
		$this->objCartStore = new cart_store();
		$this->objValidateFields = new ValidateFields();
	}

	/**
     * @fn AddCategory
     * @details REST API call for creating a new category
     */
	public function AddCategory() {

		$error = $this->objValidateFields->validateCategoryDetails($_POST['category_name'], $_POST['category_desc']);

		if (count($error) == 0) {
			$this->objCategoryStore->setCategory($_POST['category_name'], $_POST['category_desc']);
			echo HtmlGenerator::createSuccessMessage("Category has been added successfully.");
		} else {
			echo HtmlGenerator::createErrorList($error);
		}
	}

	/**
     * @fn ListCategories
     * @details REST API call for displaying category list
     * @param $displayDD - By default, it's false (display categories in list format), true (display categories in drop down)
     */
	public function ListCategories($displayDD = false) {
		$arrCategories = $this->objCategoryStore->getCategory();

        if ($displayDD == true) {
        	return HtmlGenerator::createCategoryBox($arrCategories);
        } else {
        	echo HtmlGenerator::createCategoryList($arrCategories);
        }
	}

	/**
     * @fn AddProduct
     * @details REST API call for adding a new product corresponding to a selected category
     */
	public function AddProduct() {

		$arrProductDetails = array('product_name' => $_POST['product_name'], 
									'product_desc' => $_POST['product_desc'], 
									'price' => $_POST['price'],
									'tax' => $_POST['tax'], 
									'discount' => $_POST['discount'],
									'category_id' => $_POST['category_name']
								);

		$error = $this->objValidateFields->validateProductDetails($arrProductDetails);

		if (count($error) == 0) {
			$this->objProductStore->addProduct($arrProductDetails);
			echo HtmlGenerator::createSuccessMessage("Product has been added successfully.");
		} else {
			//echo $_POST['product_name'].', '.$_POST['product_desc'].', '.$_POST['price'].', '.$_POST['tax'].', '.$_POST['discount'].', '.$_POST['category_name'];
			echo HtmlGenerator::createErrorList($error);
		}
    }

    /**
     * @fn ListProducts
     * @details REST API call for displaying products in a dropdown
     */
	public function ListProducts($displayDD = false) {
		$category = ($_POST['category_name'] != '') ? $_POST['category_name'] : 1;

		$arrProducts = $this->objProductStore->getProducts($category);

		if ($displayDD == true) {
    		return HtmlGenerator::createProductBox($arrProducts);
    	} else {
			echo HtmlGenerator::createProductBox($arrProducts);
    	}
    
	}

	/**
     * @fn CreateCart
     * @details REST API call for adding a product in the cart corresponding to a selected category
     */
	public function CreateCart() {
		$_POST['user_id'] = 1;
		$this->objCartStore->setCart($_POST['user_id'], $_POST['product'], $_POST['category_name']);
		echo HtmlGenerator::createSuccessMessage("Product has been added successfully in the cart.");
	}

	/**
     * @fn ShowCart
     * @details REST API call for displaying the cart
     */
	public function ShowCart() {
		$_POST['user_id'] = 1;

		$arrCart = $this->objCartStore->getCart($_POST['user_id']);

		echo HtmlGenerator::createCart($arrCart);
	}
}
