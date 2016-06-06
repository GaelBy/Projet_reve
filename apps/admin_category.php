<?php
if (isset($_SESSION['admin']) && $_SESSION['admin'])
{
	$id_cat = '';
	$image_cat = '';
	if (isset($_GET['id']))
	{
		$sub_cat_hide = '';
		$cat_hide = 'hide';
		if (isset($_GET['id_sub_category']))
		{
			$manager = new SubCategoryManager($link);
			$cat = $manager->getById($_GET['id_sub_category']);
			$id_cat = $cat->getCategories()->getId();
			$action = 'edit';
		}
		else
		{
			$cat = new SubCategory($link);
			$category = new Category($link);
			$cat->setCategory($category);
			$action = 'create';
		}
	}
	else
	{
		$sub_cat_hide = 'hide';
		$cat_hide = '';
		if (isset($_GET['id_category']))
		{
			$manager = new CategoryManager($link);
			$cat = $manager->getById($_GET['id_category']);
			$image_cat = $cat->getImage();
			$action = 'edit';
		}
		else
		{
			$cat = new Category($link);
			$action = 'create';
		}
	}
	require('views/admin_category.phtml');
}
?>