<?php
    use PHPUnit\Framework\TestCase;

    class AppShopTest extends TestCase{

        public function test_answerFormat_AllProducts(){
            $data = json_decode(ProductDataAccess::readAllProducts(),true);

            for($i = 0; $i < count($data); $i++){
                $this->assertArrayHasKey('id',$data[$i]);
                $this->assertArrayHasKey('name',$data[$i]);
                $this->assertArrayHasKey('quantity',$data[$i]);
                $this->assertArrayHasKey('price',$data[$i]);
                $this->assertArrayHasKey('availableUnits',$data[$i]);
                $this->assertArrayHasKey('image',$data[$i]);
            }
        }

        public function test_answerLenght_allProducts(){
            $data = json_decode(ProductDataAccess::readAllProducts(),true);
            $this->assertEquals(60,count($data));
        }

        public function test_notEmptyData_allProducts(){
            $data = json_decode(ProductDataAccess::readAllProducts(),true);

            for($i = 0; $i < count($data); $i++){
                $this->assertNotEquals('', $data[$i]['id']);
                $this->assertNotEquals('', $data[$i]['name']);
                $this->assertNotEquals('', $data[$i]['quantity']);
                $this->assertNotEquals('', $data[$i]['price']);
                $this->assertNotEquals('', $data[$i]['availableUnits']);
                $this->assertNotEquals('', $data[$i]['image']);
            }
        }

        public function test_existingId_oneProduct(){
            $_GET['productId'] = '2'; 
            $data = json_decode(ProductDataAccess::readProduct(),true);
            $this->assertFalse(empty($data));
        }

        public function test_nonExistingId_oneProduct(){
            $_GET['productId'] = '100'; 
            $data = json_decode(ProductDataAccess::readProduct(),true)[0];
            $this->assertNull($data);
        }

        public function test_answerLenght_oneProduct(){
            $_GET['productId'] = '3'; 
            $data = json_decode(ProductDataAccess::readProduct(),true);
            $this->assertEquals(1,count($data));
        }

        public function test_answerFormat_oneProduct(){
            $_GET['productId'] = '54'; 
            $data = json_decode(ProductDataAccess::readProduct(),true)[0];

            $this->assertArrayHasKey('id',$data);
            $this->assertArrayHasKey('name',$data);
            $this->assertArrayHasKey('quantity',$data);
            $this->assertArrayHasKey('price',$data);
            $this->assertArrayHasKey('availableUnits',$data);
            $this->assertArrayHasKey('image',$data);
        }

        public function test_notEmptyData_oneProduct(){
            $_GET['productId'] = '44'; 
            $data = json_decode(ProductDataAccess::readProduct(),true)[0];

            $this->assertNotEquals('', $data['id']);
            $this->assertNotEquals('', $data['name']);
            $this->assertNotEquals('', $data['quantity']);
            $this->assertNotEquals('', $data['price']);
            $this->assertNotEquals('', $data['availableUnits']);
            $this->assertNotEquals('', $data['image']);
        }

        public function test_CartProduct_Format(){
            $_GET["userName"] = "jes@gmail.com";
            $data = json_decode(CartDataAccess::readUserCartProducts(),true)[0];

            $this->assertArrayHasKey('id',$data);
            $this->assertArrayHasKey('name',$data);
            $this->assertArrayHasKey('price',$data);
            $this->assertArrayHasKey('quantity',$data);
            $this->assertArrayHasKey('availableUnits',$data);
            $this->assertArrayHasKey('image',$data);
            $this->assertArrayHasKey('brand',$data);
            $this->assertArrayHasKey('description',$data);
            $this->assertArrayHasKey('cartQuantity',$data);
        }

        public function test_CartProductId_Format(){
            $_GET["userName"] = "jes@gmail.com";
            $data = json_decode(CartDataAccess::readCartProductsId(),true)[0];

            $this->assertArrayHasKey('id',$data);
        }

        public function test_addingToCart_Lenght(){
            $_GET["userName"] = "jes@gmail.com";
            $cartLengthBeforeAdding = count(json_decode(CartDataAccess::readUserCartProducts(),true));
            $_GET["productId"] = "45";

            CartDataAccess::addProduct();

            $this->assertGreaterThan($cartLengthBeforeAdding, count(json_decode(CartDataAccess::readUserCartProducts(),true)));
        }

        public function test_addingToCart_ProductQuantity(){
            $_GET["userName"] = "jes@gmail.com";
            $_GET["productId"] = "20";
            $availableUnitsBeforeAdding = json_decode(ProductDataAccess::readProduct(),true)[0]["availableUnits"];

            CartDataAccess::addProduct();

            $this->assertGreaterThan(json_decode(ProductDataAccess::readProduct(),true)[0]["availableUnits"],
                $availableUnitsBeforeAdding
            );
        }

        public function test_increaseQuantity_Cart(){
            $_GET["userName"] = "jes@gmail.com";
            $_GET["productId"] = "45";
            $_GET["quantity"] = 1;

            $availableUnitsBeforeAdding = json_decode(ProductDataAccess::readProduct(),true)[0]["availableUnits"];

            CartDataAccess::increaseProductQuantity();

            $this->assertGreaterThan(json_decode(ProductDataAccess::readProduct(),true)[0]["availableUnits"],
                $availableUnitsBeforeAdding
            );
        }

        public function test_decreaseQuantity_Cart(){
            $_GET["userName"] = "jes@gmail.com";
            $_GET["productId"] = "45";
            $_GET["quantity"] = 1;

            $availableUnitsBeforeAdding = json_decode(ProductDataAccess::readProduct(),true)[0]["availableUnits"];

            CartDataAccess::decreaseProductQuantity();

            $this->assertGreaterThan($availableUnitsBeforeAdding,
            json_decode(ProductDataAccess::readProduct(),true)[0]["availableUnits"]
            );
        }

        public function test_removeProduct_Cart(){
            $_GET["userName"] = "jes@gmail.com";
            $_GET["productId"] = "45";

            $cartLengthBeforeRevoming = count(json_decode(CartDataAccess::readUserCartProducts(),true));

            CartDataAccess::removeProduct();

            $this->assertGreaterThan(count(json_decode(CartDataAccess::readUserCartProducts(),true)),$cartLengthBeforeRevoming);
        }

        public function test_removeAllCart_Cart(){
            $_GET["userName"] = "je@gmail.com";

            CartDataAccess::removeAllCart();
            $cartLengthAfterRemoving = count(json_decode(CartDataAccess::readUserCartProducts(),true));

            $this->assertEquals(0,$cartLengthAfterRemoving);

        }
    }
?>