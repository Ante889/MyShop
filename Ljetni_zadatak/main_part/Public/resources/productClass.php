<?php


class product{


    function createProduct(){

        global $Db;

        if(isset($_POST['submit'])){

            $title = $_POST['title'];
            $author = $_POST['author'];
            $image_name = $_FILES['image']['name'];
            $image_tmp = $_FILES['image']['tmp_name'];
            $price = $_POST['price'];
            $quantity = $_POST['quantity'];
            $category = $_POST['category'];
            $content = $_POST['content'];
            
            $rowNames=['title','author','image','price','category','quantity','content'];
            $values=[$title,$author,$image_name,$price,$category,$quantity,$content];
            $Db->Insert('products',$rowNames,$values);
            move_uploaded_file($image_tmp,"images/".$image_name);
            
            }
    }

    function showProducts(){

        global $Db;
        $rowNames=['id','title','author','image','price','category','quantity','content'];
        return $Db-> Select('products',$rowNames);        
    }

    function deleteProducts($id){

        global $Db;
        $Db->Delete('products',[$id]);
        header('location: index.php?admin'); 

    }

    function showProductsForUpdate($id){
        global $Db;
        $rowNames=['id','title','author','image','price','category','quantity','content'];
        return $Db->Select('products',$rowNames,['id'],[$id]);

    }

    function updateProducts($id){
        global $Db;
        if(isset($_POST['submit'])){

            $title = $_POST['title'];
            $author = $_POST['author'];
            $image_name = $_FILES['image']['name'];
            $image_tmp = $_FILES['image']['tmp_name'];
            $price = $_POST['price'];
            $quantity = $_POST['quantity'];
            $category = $_POST['category'];
            $content = $_POST['content'];
            if(!empty($image_name)){
                $rowNames=['title','author','image','price','category','quantity','content'];
                $values=[$title,$author,$image_name,$price,$category,$quantity,$content,$id];
                $Db->Update('products',$rowNames,$values);
                move_uploaded_file($image_tmp,"images/".$image_name);
            }else{
                $rowNames=['title','author','price','category','quantity','content'];
                $values=[$title,$author,$price,$category,$quantity,$content,$id];
                $Db->Update('products',$rowNames,$values);
            }
            
            }

    }
}

$product = new product;
?>