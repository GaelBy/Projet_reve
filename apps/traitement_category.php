<?php
if (isset($_SESSION['admin'],$_POST) && $_SESSION['admin'] && !empty($_POST))
    {
    	if (isset($_GET['id']))
    	{
    		try
    		{
	    		$manager = new SubCategoryManager($link);
	    		//create
		    	if (isset($_GET['action']) && $_GET['action'] == 'create')
		    	{
		    		$sub_category = $manager->create($_POST);
		    	}
		    	//edit
		    	else if (isset($_GET['action']) && $_GET['action'] == 'edit')
		    	{
		    		$sub_category = $manager->getById($_GET['id_sub_category']);
		    		$sub_category->setNom($_POST['nom']);
		    		$sub_category->setDescription($_POST['description']);
		    		$sub_category->setIdCategory($_POST['id_category']);
		    		$sub_category->setStatut($_POST['statut']);
		    		$sub_category = $manager->update($sub_category);
		    	}
		    	header('Location: index.php?page=sub_category&id_sub_category='.$sub_category->getId());
				exit;
    		}
    		catch(Exception $e)
    		{
    			$error = $e->getMessage();
    		}
    	}
    	else
    	{
    		try
    		{
	    		$manager = new CategoryManager($link);
	    		//create
		    	if (isset($_GET['action']) && $_GET['action'] == 'create')
		    	{
		    		$category = $manager->create($_POST);
		    	}
		    	//edit
		    	else if (isset($_GET['action']) && $_GET['action'] == 'edit')
		    	{
		    		$category = $manager->getById($_GET['id_category']);
		    		$category->setNom($_POST['nom']);
		    		$category->setDescription($_POST['description']);
		    		$category->setImage($_POST['image']);
		    		$category->setStatut($_POST['statut']);
		    		$category = $manager->update($category);
		    	}
		    	header('Location: index.php?page=category&id='.$category->getId());
				exit;
    		}
    		catch(Exception $e)
    		{
    			$error = $e->getMessage();
    		}
    	}
    }
?>