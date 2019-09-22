<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{!! csrf_token() !!}" />

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
       
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            #addPay:hover{
                color: crimson;
                transition: 0.5s ease-out 0,5s;
            }
            .addPopup{
                width: 100%;
                position: absolute;
                top: 10%;
                background-color: white;
                border:1px solid #ccc;
                z-index: 9999;
                padding: 20px;
                display: none;
            }
            #close{
                position: absolute;
                right: 1%;
                top: 1%;
                cursor: pointer;
                font-weight: 600;
                font-size: 20px;
            }
            .catPopup{
                width: 100%;
                position: absolute;
                top: 10%;
                background-color: white;
                border:1px solid #ccc;
                z-index: 9999;
                padding: 20px;
                display: none;
            }
            #closeCat{
                position: absolute;
                right: 1%;
                top: 1%;
                cursor: pointer;
                font-weight: 600;
                font-size: 20px;
            }
            .daterangepicker{
              z-index: 99999;
            }
        </style>
    </head>
    <body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="#">Учет финансов</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto ml-3">
      
      <li class="nav-item active">
        <a href="" class="nav-link" id="addPay">Добавить расход</a>
      </li>
      <li class="nav-item active">
        <input type="text" name="daterange" value="01/01/2018 - 01/15/2018" class="mt-1" />
        
      </li>
      <li class="nav-item active">
        <a href="" class="nav-link" id="findCat">Поиск по категории</a>
      </li>
    </ul>
  </div>
</nav>
       <div class="container">
        <div class="row">
          <div class="col-10 offset-1">
            <div class="catPopup">
    <span id="closeCat">X</span> 
    <div class="form-group">     
        <input type="text" name="daterange1" value="01/01/2018 - 01/15/2018" class="mt-1" />
      </div>
      <div class="form-group">
      <label for="category">Категория</label>
                <select class="form-control" id="catFind" required="">
                  @foreach($cats as $cat)
                  <option value="{{$cat->id}}">{{$cat->category_name}}</option>
                  @endforeach
                </select>
              </div>
              <button class="btn btn-success" id="findCatBtn">Добавить</button>

  </div>
          </div>
        </div>
        <div class="row">
          <div class="col-10 offset-1">
            <div class="addPopup">
            <span id="close">X</span>
              <div class="form-group">
                <label for="name">Название</label>
                <input type="text" class="form-control" id="item" placeholder="" required="">
              </div>
               <div class="form-group">
                <label for="price">Цена</label>
                <input type="number" class="form-control" id="price" placeholder="" required="">
              </div>
              <div class="form-group">
                <label for="category">Категория</label>
                <select class="form-control" id="category" required="">
                  @foreach($cats as $cat)
                  <option value="{{$cat->id}}">{{$cat->category_name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="comment">Комментарий</label>
                <textarea class="form-control" id="comment" rows="3"></textarea>
              </div>
               <div class="form-group">
                <input type="radio" id="nameAnd"
                 name="contact" value="Андрей" class="nameCheck">
                <label for="nameAnd">Андрей</label>

                <input type="radio" id="nameKat"
                 name="contact" value="Катя" class="nameCheck">
                <label for="nameKat">Катя</label>
               
              </div>
              <button class="btn btn-success" id="addSpending">Добавить</button>
        </div>
          </div>
        </div>
           <div class="row mt-5">
               <div class="col-lg-6 col-md-12">
                <h2 class="text-center">Андрей</h2>
                   <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Название</th>
      <th scope="col">Цена</th>
      <th scope="col">Категория</th>
    </tr>
  </thead>
  <tbody id="andBody">
    @foreach($spendsAnd as $spendAnd)
    <tr>
      <td>{{$spendAnd->id}}</td>
      <td>{{$spendAnd->item}}</td>
      <td>{{$spendAnd->money_count}} p.</td>
      <td>{{$spendAnd->category_name}}</td>
    </tr>
    @endforeach
    
  </tbody>
</table>


               </div>
               <div class="col-lg-6 col-md-12">
                <h2 class="text-center">Катя</h2>

                   <table class="table">
  <thead class="thead-light">
    <tr>
      <tr>
      <th scope="col">#</th>
      <th scope="col">Название</th>
      <th scope="col">Цена</th>
      <th scope="col">Категория</th>
    </tr>
    </tr>
  </thead>
  <tbody id="kateBody">
    @foreach($spendsKate as $spendKate)
    <tr>
      <td>{{$spendKate->id}}</td>
      <td>{{$spendKate->item}}</td>
      <td>{{$spendKate->money_count}} p.</td>
      <td>{{$spendKate->category_name}}</td>
    </tr>
    @endforeach

  </tbody>
</table>
               </div>
           </div>
       </div>
        <!-- Scripts -->
         <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript" src="../resources/js/app.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                  var today = new Date();
                    var dd = today.getDate();
                    var mm = today.getMonth() + 1; //January is 0!

                    var yyyy = today.getFullYear();
                    if (dd < 10) {
                      dd = '0' + dd;
                    } 
                    if (mm < 10) {
                      mm = '0' + mm;
                    } 
                    var today = mm + '/' + dd + '/' + yyyy;


                 jQuery('input[name="daterange"]').daterangepicker({
                    opens: 'left',
                    startDate: today,

                  }, function(start, end, label) {
                    console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
                    var startTime = start.format('YYYY-MM-DD');
                    var endTime = end.format('YYYY-MM-DD');

                    $.ajax({
                    type:'POST',
                    url:'ajaxDate',
                    headers: {
          'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
     },
                    data:{start:startTime, end:endTime},
                    success:function(resp){
                      console.log(resp);
                      $('#andBody').html('');
                      $('#kateBody').html('');
                      $.each(resp.and, function(index, val) {
                          console.log(val);
                          $('#andBody').append('<tr>\
                            <td>'+val.id+'</td>\
                            <td>'+val.item+'</td>\
                            <td>'+val.money_count+'p.</td>\
                            <td>'+val.category_name+'</td>\
                            <td>'+val.comment+'</td>\
                          </tr>');
                      });
                      $.each(resp.kate, function(index, val) {
                          console.log(val);
                          $('#kateBody').append('<tr>\
                            <td>'+val.id+'</td>\
                            <td>'+val.item+'</td>\
                            <td>'+val.money_count+'p.</td>\
                            <td>'+val.category_name+'</td>\
                            <td>'+val.comment+'</td>\
                          </tr>');
                      });
                    }

                  });
                  });    

                 $('#addPay').on('click',function(e){
                    e.preventDefault();
                    $('.addPopup').fadeIn();

                 });
                 $('#close').on('click',function(e){
                    $('.addPopup').fadeOut();
                 });
                 $('#addSpending').on('click',function(e){
                  e.preventDefault();
                  var itemAj = $('#item').val();
                  var categoryAj = $('#category').val();
                  var priceAj = $('#price').val();
                  var nameAj = $('input[name=contact]:checked').val();
                  var commentAj = $('#comment').val();
                   $.ajax({
                    type:'POST',
                    url:'ajaxAdd',
                    headers: {
          'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
     },
                    data:{item:itemAj, category:categoryAj,price:priceAj,name:nameAj, comment:commentAj},
                    success:function(resp){
                      console.log(resp);
                      location.reload();

                 }
            });
           });
                 $('#findCat').on('click',function(e){
                  e.preventDefault();
                  $('.catPopup').fadeIn();
                 });
                 $('#closeCat').on('click',function(e){
                    $('.catPopup').fadeOut();
                 });
                   jQuery('input[name="daterange1"]').daterangepicker({
                    opens: 'left',
                    startDate: today,

                  }, function(start, end, label) {
                    console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
                     startTimeCat = start.format('YYYY-MM-DD');
                     endTimeCat = end.format('YYYY-MM-DD');
                     catFind = $('#catFind').val();
                    
                 
                  });  
                   $('#findCatBtn').on('click',function(e){
                      console.log(catFind);
                    console.log(startTimeCat);
                    console.log(endTimeCat);
                      $.ajax({
                    type:'POST',
                    url:'ajaxCat',
                    headers: {
          'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
     },
                    data:{start:startTimeCat, end:endTimeCat,category:catFind},
                    success:function(resp){
                      console.log(resp);
                      $('#andBody').html('');
                      $('#kateBody').html('');
                      $.each(resp.and, function(index, val) {
                          console.log(val);
                          $('#andBody').append('<tr>\
                            <td>'+val.id+'</td>\
                            <td>'+val.item+'</td>\
                            <td>'+val.money_count+'p.</td>\
                            <td>'+val.category_name+'</td>\
                            <td>'+val.comment+'</td>\
                          </tr>');
                      });
                      $.each(resp.kate, function(index, val) {
                          console.log(val);
                          $('#kateBody').append('<tr>\
                            <td>'+val.id+'</td>\
                            <td>'+val.item+'</td>\
                            <td>'+val.money_count+'p.</td>\
                            <td>'+val.category_name+'</td>\
                            <td>'+val.comment+'</td>\
                          </tr>');
                      });
                      $('.catPopup').fadeOut();
                    }

                  });
                   });
               });
        </script>
    </body>
</html>
