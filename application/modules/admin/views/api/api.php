<section>
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	BASE_URL=http://localhost/anugrah/index.php/api/


	URL: users/login
	universityrollno: 171500054
	password:anugrah
	device_token: jjjjj
	Response:
	True:
	{
	"status": true,
	"message": "login successfull",
	"data": {
	"id": "2",
	"name": "Anugrah Agarwal",
	"email": "anu@go.com",
	"password": "d3ccb844ac68bc324e6c95e94c05e477",
	"universityrollno": "171500054",
	"year_id": "1",
	"address": "",
	"user_type": "2",
	"mobile": "7895905598",
	"created": "1573307529",
	"status": "1",
	"device_token": "asdfaweqw",
	"year_name": "1st"
	}
	}
	False:
	{
	"status": false,
	"message": "Username does not exist",
	"data": {}
	}
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	URL: users/forget_password
	username: anugrahagarwal7890@gmail.com
	//otp sent
	{
	"status": true,
	"message": "OTP Sent",
	"data": {
	"otp": 392354
	}
	}
	otp:392354
	password:anugrah123
	Response:
	True:
	{
	"status": true,
	"message": "Password Changed",
	"data": {
	"id": "2",
	"name": "Anugrah Agarwal",
	"email": "anugrahagarwal7890@gmail.com",
	"password": "d3ccb844ac68bc324e6c95e94c05e477",
	"universityrollno": "171500054",
	"year_id": "1",
	"address": "",
	"user_type": "2",
	"mobile": "7895905598",
	"created": "1573307529",
	"status": "1",
	"device_token": "asdfaweqw"
	}
	}

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	URL: users/change_password
	user_id: 2
	password:anugrah222

	Response:
	True:
	{
	"status": true,
	"message": "Password Changed",
	"data": []
	}
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	URL: users/registeration
	user_id: 2
	name:aryan
	universityrollno:171500123
	email:aryan@gmail.com
	mobile:7412589630
	password:aryan
	year_id:1
	device_token:jjjjjj

	//otp sent
	{
	"status": true,
	"message": "OTP Sent",
	"data": {
	"otp": 108790
	}
	}

	otp;108790

	Response:
	True:
	{
	"status": true,
	"message": "USER REGISTERED",
	"data": {
	"name": "ama singhal",
	"universityrollno": "171500038",
	"email": "aman@gmail.com",
	"mobile": "2587413690",
	"password": "3dd302568893afdd6a54fd6bda49e404",
	"year_id": "3",
	"device_token": "ddjdh",
	"status": 1,
	"created": 1573411649,
	"user_type": 2,
	"id": 8,
	"otp": "108790\n"
	}
	}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	URL: home/category
	user_id: 2

	Response:
	True:
	{
	"status": true,
	"message": "Category Displayed",
	"data": [
	{
	"id": "1",
	"name": "Snacks",
	"created": "1573328033",
	"status": "1"
	},
	{
	"id": "2",
	"name": "Drinks",
	"created": "1573329841",
	"status": "1"
	},
	{
	"id": "3",
	"name": "Chinese",
	"created": "1573405317",
	"status": "1"
	}
	]
	}

	False:
	{
	"status": false,
	"message": [
	"The user_id field is required."
	],
	"data": []
	}
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	URL: home/food
	user_id: 2
	category_id:2

	Respomse:
	True:
	{
	"status": true,
	"message": "Category Displayed",
	"data": [
	{
	"id": "4",
	"name": "qer",
	"price": "12",
	"image": "http://localhost/anugrah/uploads/1573412777.png",
	"stock": "12",
	"category_id": "2",
	"created": "1573412777",
	"modify": "0",
	"status": "1"
	}
	]
	}

	False:
	{
	"status": false,
	"message": "Category Not Found",
	"data": []
	}

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	URL: home/feedback
	user_id: 2
	feedback:hey babs

	Response:
	True:
	{
	"status": true,
	"message": "Feedback Submitted",
	"data": []
	}
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	URL: home/myorder
	user_id: 2

	Response:
	True:

	{
	"status": true,
	"message": "My Order List Displayed",
	"data": [
	{
	"food_name": "qer",
	"image": "http://localhost/anugrah/uploads/1573412630.png",
	"total_price": "220",
	"quantity": "5",
	"order_number": "120"
	}
	]
	}

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

	URL: home/cart
	user_id: 2
	cart_id:4
	food_id:2
	quantity:5
	transaction:2  //Payment Left

	Responnse:
	True:
	{
	"status": true,
	"message": "PAYMENT LEFT",
	"data": {
	"user_id": "2",
	"food_id": "2",
	"quantity": "5",
	"transaction": "2",
	"status": 1,
	"created": 1573417117,
	"total_price": 60,
	"order_number": 4820,
	"cart_id": 5
	}
	}


	user_id: 2
	cart_id:4
	food_id:2
	quantity:5
	transaction:1  //Payment Done


	{
	"status": true,
	"message": "PAYMENT DONE",
	"data": {
	"user_id": "2",
	"cart_id": "4",
	"food_id": "2",
	"quantity": "5",
	"transaction": "1",
	"status": 1,
	"created": 1573417157,
	"total_price": 60,
	"order_number": "5757"
	}
	}

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	URL: home/remove
	cart_id:2
	transaction:1 //Payment Done

	Responnse:
	True:
	{
	"status": false,
	"message": "Payment Already Done",
	"data": []
	}

	transaction:2 //Payment Left

	{
	"status": true,
	"message": "Cart Removed",
	"data": []
	}
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////
</section>
