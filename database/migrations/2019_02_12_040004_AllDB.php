<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AllDB extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('sellers', function (Blueprint $table) {
        $table->increments('id');
        $table->string('name',50);
        $table->string('surname',50);
        $table->string('avatar');
        $table->string('email',50)->unique();
        $table->string('fbAccount');
        $table->timestamps();
    });

       Schema::create('brands', function (Blueprint $table) {
        $table->unsignedInteger('seller_id');
        $table->increments('brand_id');
        $table->foreign('seller_id')->references('id')->on('sellers')->onDelete('cascade');
        $table->string('brand_name',50);
        $table->string('brand_des',100);
        $table->string('brand_logo',50)->nullable();

        $table->integer('brand_status');
        $table->timestamps();
    });

    Schema::create('Banks', function (Blueprint $table) {
     $table->increments('Bank_id');
     $table->string('Bank_name',100);
 });

     Schema::create('bank_accounts', function (Blueprint $table) {
      $table->unsignedInteger('bank_id');
      $table->unsignedInteger('seller_id');

      $table->increments('BankAccount_id');
      $table->string('account_name',100);
      $table->string('bank_account',20);
      $table->integer('status');

      $table->foreign('bank_id')->references('bank_id')->on('banks')->onDelete('cascade');
      $table->foreign('seller_id')->references('id')->on('sellers')->onDelete('cascade');
      $table->timestamps();
      });

       Schema::create('catagoiesRooms', function (Blueprint $table) {
        $table->increments('CatRoom_id');
        $table->string('CatRoom_name',50);
    });
       Schema::create('catagoiesProducts', function (Blueprint $table) {
        $table->unsignedInteger('CatRoom_id');
        $table->increments('CatProd_id');
        $table->foreign('CatRoom_id')->references('CatRoom_id')->on('catagoiesRooms')->onDelete('cascade');
        $table->string('CatProd_name',50);
    });
       Schema::create('colorProducts', function (Blueprint $table) {
        $table->unsignedInteger('CatProd_id');

        $table->increments('ColorProd_id');
        $table->foreign('CatProd_id')->references('CatProd_id')->on('catagoiesProducts')->onDelete('cascade');
        $table->string('ColorProd_value',50);
        $table->timestamps();
    });
       Schema::create('sizeProducts', function (Blueprint $table) {
        $table->unsignedInteger('CatProd_id');

        $table->increments('SizeProd_id');
        $table->foreign('CatProd_id')->references('CatProd_id')->on('catagoiesProducts')->onDelete('cascade');
        $table->double('SizeProd_width');
        $table->double('SizeProd_height');
        $table->double('SizeProd_length');
        $table->double('SizeProd_foot')->nullable();
        $table->timestamps();
    });
       Schema::create('RMProducts', function (Blueprint $table) {
        $table->unsignedInteger('CatProd_id');

        $table->increments('RM_id');
        $table->foreign('CatProd_id')->references('CatProd_id')->on('catagoiesProducts')->onDelete('cascade');
        $table->string('RM_value',50);
        $table->timestamps();
    });
       Schema::create('products', function (Blueprint $table) {
        $table->unsignedInteger('brand_id');
        $table->unsignedInteger('CatProd_id');
        $table->unsignedInteger('SizeProd_id');
        $table->unsignedInteger('ColorProd_id');
        $table->unsignedInteger('RM_id');


        $table->increments('Prod_id');
        $table->string('prod_name',120);
        $table->string('prod_desc',5000)->nullable();
        $table->integer('prod_price');
        $table->integer('qty');
        $table->string('sku',20)->nullable();
        $table->integer('weight');

        $table->integer('status');
        $table->integer('show');

        $table->string('pic_url1')->nullable();
        $table->string('pic_url2')->nullable();
        $table->string('pic_url3')->nullable();
        $table->string('pic_url4')->nullable();
        $table->string('pic_url5')->nullable();
        $table->foreign('CatProd_id')->references('CatProd_id')->on('catagoiesProducts')->onDelete('cascade');
        $table->foreign('brand_id')->references('brand_id')->on('brands')->onDelete('cascade');

        $table->foreign('SizeProd_id')->references('SizeProd_id')->on('sizeProducts')->onDelete('cascade');
        $table->foreign('ColorProd_id')->references('ColorProd_id')->on('colorProducts')->onDelete('cascade');
        $table->foreign('RM_id')->references('RM_id')->on('RMProducts')->onDelete('cascade');

        $table->timestamps();

    });


       Schema::create('Deliverys', function (Blueprint $table) {
         $table->increments('Delivery_id');
         $table->string('DeliveryName');
     });

       Schema::create('Delivery_prices', function (Blueprint $table) {
           $table->unsignedInteger('Delivery_id');
           $table->unsignedInteger('Prod_id');

           $table->increments('del_price_id');
           $table->integer('Price')->nullable();
           $table->foreign('Delivery_id')->references('Delivery_id')->on('Deliverys')->onDelete('cascade');
           $table->foreign('Prod_id')->references('Prod_id')->on('products')->onDelete('cascade');
           $table->timestamps();
       });

       Schema::create('Reviews', function (Blueprint $table) {
         $table->unsignedInteger('Prod_id');
         $table->unsignedInteger('Buyer_id');

         $table->increments('Review_id');
         $table->float('rating');
         $table->string('description')->nullable();
         $table->foreign('Prod_id')->references('Prod_id')->on('products')->onDelete('cascade');
         $table->foreign('Buyer_id')->references('id')->on('buyers')->onDelete('cascade');
         $table->timestamps();
     });

     Schema::create('Addresses', function (Blueprint $table) {
       $table->unsignedInteger('Buyer_id');

       $table->increments('Add_id');
       $table->string('area',300);
       $table->string('district',50);
       $table->string('province',50);
       $table->string('zipcode',50);
       $table->integer('status');

       $table->foreign('Buyer_id')->references('id')->on('buyers')->onDelete('cascade');
       $table->timestamps();
     });

     Schema::create('Carts', function (Blueprint $table) {
       $table->unsignedInteger('Buyer_id');

       $table->increments('Cart_id')->start_from(100000);
       $table->integer('NumOfProduct')->nullable();
       $table->integer('Price')->nullable();
       $table->foreign('Buyer_id')->references('id')->on('buyers')->onDelete('cascade');
       $table->timestamps();
     });

     Schema::create('Product_In_Carts', function (Blueprint $table) {
       $table->unsignedInteger('Cart_id');
       $table->unsignedInteger('Prod_id');

       $table->foreign('Prod_id')->references('Prod_id')->on('products')->onDelete('cascade');
       $table->foreign('Cart_id')->references('Cart_id')->on('Carts')->onDelete('cascade');
       $table->integer('count');
       $table->timestamps();
     });

     Schema::create('Orders', function (Blueprint $table) {
       $table->unsignedInteger('Cart_id');

       $table->increments('Order_id')->start_from(100000);
       $table->integer('total_price');
       $table->integer('status');

       $table->foreign('Cart_id')->references('Cart_id')->on('Carts')->onDelete('cascade');
       $table->timestamps();
     });

     Schema::create('orderDetails', function (Blueprint $table) {
       $table->unsignedInteger('Order_id');
       $table->unsignedInteger('Prod_id');
       $table->unsignedInteger('del_price_id');
       $table->unsignedInteger('Add_id');

       $table->string('order_detail_id',20)->primary();
       $table->DateTime('requiredDate');
       $table->integer('price');
       $table->integer('count');
       $table->integer('status');

       $table->foreign('Prod_id')->references('Prod_id')->on('products')->onDelete('cascade');
       $table->foreign('Order_id')->references('Order_id')->on('Orders')->onDelete('cascade');
       $table->foreign('del_price_id')->references('del_price_id')->on('Delivery_prices')->onDelete('cascade');
       $table->foreign('Add_id')->references('Add_id')->on('Addresses')->onDelete('cascade');
       $table->timestamps();
     });

     Schema::create('Payments', function (Blueprint $table) {
       $table->unsignedInteger('BankAccount_id');
       $table->unsignedInteger('order_id');
       $table->increments('pay_id');
       
       $table->string('transfer_slip')->nullable();
       $table->string('bank_account');
       $table->string('bank_name');
       $table->DateTime('date_time');
       $table->float('amount');
       $table->integer('pay_status');

       $table->foreign('BankAccount_id')->references('BankAccount_id')->on('bank_accounts')->onDelete('cascade');
       $table->foreign('order_id')->references('order_id')->on('orders')->onDelete('cascade');
       $table->timestamps();
     });

     Schema::create('Trackings', function (Blueprint $table) {

       $table->increments('Track_id');
       $table->string('Track_number',100);
       $table->integer('status');

       $table->string('order_detail_id')->references('orderDetails')->on('order_detail_id')->onDelete('cascade');

       $table->timestamps();
     });

     Schema::create('Stocks', function (Blueprint $table) {
       $table->unsignedInteger('Prod_id');

       $table->increments('stock_id');
       $table->integer('qty_before');
       $table->integer('qty_after');
       $table->integer('qty_sold');
       $table->integer('prod_price');
       $table->integer('price');
       $table->DateTime('DateTime');

       $table->foreign('Prod_id')->references('Prod_id')->on('Products')->onDelete('cascade');
       $table->timestamps();
     });

     Schema::create('Keyword_values', function (Blueprint $table) {
       $table->increments('keyword_value_id');
       $table->string('keyword_value',30);
       $table->timestamps();
     });

     Schema::create('Keywords', function (Blueprint $table) {
       $table->increments('keyword_id');

       $table->unsignedInteger('Prod_id');
       $table->unsignedInteger('keyword_value_id');

       $table->foreign('Prod_id')->references('Prod_id')->on('Products')->onDelete('cascade');
       $table->foreign('keyword_value_id')->references('keyword_value_id')->on('Keyword_values')->onDelete('cascade');
       $table->timestamps();
     });




  //insert Data ประเภทห้อง
       DB::table('catagoiesRooms')->insert(array('CatRoom_name' => 'ห้องนอน'));
       DB::table('catagoiesRooms')->insert(array('CatRoom_name' => 'ห้องนั่งเล่น'));
       DB::table('catagoiesRooms')->insert(array('CatRoom_name' => 'ห้องทำงาน'));

  //insert ห้องนอน
       DB::table('catagoiesProducts')->insert(array('CatProd_name' => 'เตียง','CatRoom_id' => 1));
       DB::table('catagoiesProducts')->insert(array('CatProd_name' => 'โต๊ะข้างเตียง','CatRoom_id' => 1));
       DB::table('catagoiesProducts')->insert(array('CatProd_name' => 'โซฟา','CatRoom_id' => 1));
       DB::table('catagoiesProducts')->insert(array('CatProd_name' => 'ตู้เสื้อผ้า','CatRoom_id' => 1));

  //insert ห้องนั่งเล่น
       DB::table('catagoiesProducts')->insert(array('CatProd_name' => 'เก้าอี้','CatRoom_id' => 2));
       DB::table('catagoiesProducts')->insert(array('CatProd_name' => 'ชั้นวางทีวี','CatRoom_id' => 2));
       DB::table('catagoiesProducts')->insert(array('CatProd_name' => 'โซฟา','CatRoom_id' => 2));
       DB::table('catagoiesProducts')->insert(array('CatProd_name' => 'ชั้นวางของ','CatRoom_id' => 2));

  //insert ห้องทำงาน
       DB::table('catagoiesProducts')->insert(array('CatProd_name' => 'โต๊ะทำงาน','CatRoom_id' => 3));
       DB::table('catagoiesProducts')->insert(array('CatProd_name' => 'ตู้หนังสือ','CatRoom_id' => 3));

  //insert การจัดส่ง
       DB::table('Deliverys')->insert(array('DeliveryName' => 'Kerry'));
       DB::table('Deliverys')->insert(array('DeliveryName' => 'DHL'));
       DB::table('Deliverys')->insert(array('DeliveryName' => 'SB'));
       DB::table('Deliverys')->insert(array('DeliveryName' => 'EMS'));
       DB::table('Deliverys')->insert(array('DeliveryName' => 'Buyer'));
       DB::table('Deliverys')->insert(array('DeliveryName' => 'Seller'));

  //insert ธนาคาร
             DB::table('Banks')->insert(array('Bank_name' => 'กสิกรไทย'));
             DB::table('Banks')->insert(array('Bank_name' => 'ไทยพาณิชย์'));
             DB::table('Banks')->insert(array('Bank_name' => 'กรุงเทพ'));
             DB::table('Banks')->insert(array('Bank_name' => 'กรุงไทย'));
             DB::table('Banks')->insert(array('Bank_name' => 'กรุงศรีอธุธยา'));
             DB::table('Banks')->insert(array('Bank_name' => 'ทหารไทย'));
             DB::table('Banks')->insert(array('Bank_name' => 'พร้อมเพย์'));


   }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
}
