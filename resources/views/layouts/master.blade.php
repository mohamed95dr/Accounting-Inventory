<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="Description" content="Bootstrap Responsive Admin Web Dashboard HTML5 Template">
    <meta name="Author" content="Spruko Technologies Private Limited">
    <meta name="Keywords"
        content="admin,admin dashboard,admin dashboard template,admin panel template,admin template,admin theme,bootstrap 4 admin template,bootstrap 4 dashboard,bootstrap admin,bootstrap admin dashboard,bootstrap admin panel,bootstrap admin template,bootstrap admin theme,bootstrap dashboard,bootstrap form template,bootstrap panel,bootstrap ui kit,dashboard bootstrap 4,dashboard design,dashboard html,dashboard template,dashboard ui kit,envato templates,flat ui,html,html and css templates,html dashboard template,html5,jquery html,premium,premium quality,sidebar bootstrap 4,template admin bootstrap 4" />
    @include('layouts.head')
</head>

<body class="main-body app sidebar-mini">
    <!-- Loader -->
    <div id="global-loader">
        <img src="{{ URL::asset('assets/img/loader.svg') }}" class="loader-img" alt="Loader">
    </div>
    <!-- /Loader -->
    @include('layouts.main-sidebar')
    <!-- main-content -->
    <div class="main-content app-content">
        @include('layouts.main-header')
        <!-- container -->
        <div class="container-fluid">
            @yield('page-header')
            @yield('content')
            @include('layouts.sidebar')
            @include('layouts.models')
            @include('layouts.footer')
            @include('layouts.footer-scripts')
        </div>

        <script>
            var Purchasing_price;
            var quentity;

            function myFunction(p) {

                Purchasing_price = document.getElementById('Purchasing_price' + p).value;
                quentity = document.getElementById('quentity' + p).value;
                var Amount_Commission = parseFloat(document.getElementById("Amount_Commission").value);
                document.getElementById("Amount_Commission").value = Amount_Commission + Purchasing_price * quentity;


                console.log('Amount_Commission :', Amount_Commission);
                console.log('Purchasing_price :', Purchasing_price);
                console.log('quentity :', quentity);
                console.log('product number :', p);

                var Discount = parseInt(document.getElementById('Discount').value);

                var Amount_Commission = parseInt(document.getElementById('Amount_Commission').value);


                document.getElementById("Total_Amount").value = Amount_Commission + Discount;


            }

            function fetch_supplier_debt(supplier_id) {

                console.log(supplier_id);

                const xhttp = new XMLHttpRequest();
                xhttp.onload = function() {
                    console.log(this.responseText);
                    parseFloat(document.getElementById("Discount").value = this.responseText);
                }
                xhttp.open("GET", 'http://127.0.0.1:8000/debt/' + supplier_id, true);
                xhttp.send();

            }

            function checkCategoryIfExis(category_field){
                console.log(category_field.value);
                
                const xhttp = new XMLHttpRequest();
                xhttp.onload = function() {
                    console.log("get route :", this.responseText);
                    if (this.responseText == false) {
                        // category_field.value="not found please enter again";
                        category_field.value="";
                    }
                    

                }
                xhttp.open("GET", 'http://127.0.0.1:8000/category/' + category_field.value, true);
                xhttp.send();

            }

            function changetoDate(i){
                console.log(i);
                document.getElementById("")
            }

            function fetch_customer_debt(customer_id) {

                console.log(customer_id);

                const xhttp = new XMLHttpRequest();
                xhttp.onload = function() {
                    console.log(this.responseText);
                    document.getElementById("Discount").value = this.responseText;
                }
                xhttp.open("GET", 'http://127.0.0.1:8000/saleDebt/' + customer_id, true);
                xhttp.send();

            }

            function check_quentity(q, i) {
                console.log(q);
                console.log(i);
                var pid = document.getElementById("pid" + i).value;
                console.log("pid :::::::::::", pid);

                const xhttp = new XMLHttpRequest();
                xhttp.onload = function() {
                    console.log("get route :", this.responseText);
                    let quantity = this.responseText;
                    if (q > quantity) {
                        document.getElementById("quentity" + i).value = this.responseText;
                    }

                }
                xhttp.open("GET", 'http://127.0.0.1:8000/getProductQuantity/' + pid, true);
                xhttp.send();


            }

            function checkCustomerType(i) {
                let customerId = document.getElementById("customer_id").value;
                console.log("customerId::::::::::::::", customerId);


                const xhttp = new XMLHttpRequest();
                xhttp.onload = function() {
                    console.log("get route :", this.responseText);
                    let customerType = this.responseText;
                    if (customerType == "جملة") {
                        document.getElementById("Wholesale_price" + i).removeAttribute("disabled");
                    } else if (customerType == "مفرق"){
                        console.log("مفرقققق");
                        document.getElementById("retail_price" + i).removeAttribute("disabled");
                    }

                }
                xhttp.open("GET", 'http://127.0.0.1:8000/getCustomerType/' + customerId, true);
                xhttp.send();

            }

            var Wholesale_price;
            var retail_price;
            
            function saleInv(p) {

                Wholesale_price = document.getElementById('Wholesale_price' + p);
                console.log('Wholesale_price :', Wholesale_price);

                retail_price = document.getElementById('retail_price' + p);
                console.log('retail_price :', retail_price);

                let price ;
                if(Wholesale_price.hasAttribute('disabled')){
                    price = retail_price.value;
                }
                else if(retail_price.hasAttribute('disabled')){
                    price = Wholesale_price.value;
                }

                quentity = document.getElementById('quentity' + p).value;
                var Amount_Commission = parseFloat(document.getElementById("Amount_Commission").value);

                document.getElementById("Amount_Commission").value = Amount_Commission + price * quentity;


                console.log('Amount_Commission :', Amount_Commission);
                console.log('price :', price);
                console.log('quentity :', quentity);
                console.log('product number :', p);

                var Discount = parseInt(document.getElementById('Discount').value);

                var Amount_Commission = parseInt(document.getElementById('Amount_Commission').value);


                document.getElementById("Total_Amount").value = Amount_Commission + Discount;


            }


        </script>
</body>

</html>
