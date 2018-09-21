<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	
	<h1>	Hello  {{$user->name}} ,</h1>
	<h3> Welcome to One Love, Please click the button below to activate your account. </h3>
	<button class="btn btn-success"><a href="http://oneloveproposal.herokuapp.com/activate/{{$user->id}}">Activate Account</a></button>
	<p>	Thank you for registering with us.</p>
	
</body>
</html>