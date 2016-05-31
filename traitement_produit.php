<?php


if(TRUE)
{
	//création produit
	$manager=new ProduitsManager($link);
	$manager->create
		$produit->set$_POST['title']);
		$produit->setContent($_POST['content']);
		$manager->update($produit);
		header('Location: index.php');
	exit;

	}
			catch (Exception $exception)
			{
				$error = $exception->getMessage();
			}

}





?>