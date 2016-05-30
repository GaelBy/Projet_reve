<?php

$option_prod =new Produitsmanager($link);

if(isset($_SESSION['login']))
	{

	try

        {


			if (isset($_GET['action'])&& $_GET['action'] == "creer" )
			
			{

            $option_prod ->greate($_POST);

	        header('Location:index.php?page=produits');
			}
			else if(isset($_GET['action']) && $_GET['action'] == "modifier")
			{
	         
            $option_prod ->update($this);

	        header('Location:index.php?page=produits');
			}
			else if(isset($_GET['action']) && $_GET['action'] == "supprimer")
			{
	        

            $option_prod ->delete($this);

	        header('Location:index.php?page=produits');
			}


        


        header('Location:index.php?page=produits');





        catch (Exception $e);
        {
        	$error = $e->getMessage;
        }


    }


  

?>