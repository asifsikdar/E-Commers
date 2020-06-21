<!DOCTYPE html>
<html>
<head>
	<title>@yield('title') | Laravel 7</title>

	<style type="text/css">
		
		.main{

		}
		.header{
			text-align:center; 
			padding: 5px;
			background: black;
			color: white;
			font-size: 25px;
		}
		.content{
			height: 600px;
			margin: 10px;
			background:silver;
		}
		.footer{
			text-align:center; 
			padding: 5px;
			background: black;
			color: white;
		}
	</style>
</head>
<body>


	<section class="main">
		<section class="header">Header</section>
		<section class="content">
			
       @if(count($errors) > 0)
      <ul>	
      	@foreach($errors->all() as $row)
             <li>

             {{$row}}	

             </li>
      	@endforeach
      </ul>
       @endif



       @if(Session::has('success'))

       <p>	{{Session::get('success')}}</p>

       @endif


       @yield('content')

   		</section>
		<section class="footer">Footer</section>
	</section>

</body>
</html>