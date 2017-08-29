<?php



?>
<!Doctype html>
<!DOCTYPE html>
<html>
<head>
	<title>Testing for the trello API</title>
	<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
    <script src="https://api.trello.com/1/client.js?key=cf18ee8b11cafc6a2b7569c0104b485d"></script>
    <script type="text/javascript">
    $(document).ready(function(){
         var authenticationSuccess = function() {
     console.log('Successful authentication');
     };

   var authenticationFailure = function() {
     console.log('Failed authentication');
   };    	

  window.Trello.authorize({
  type: 'popup',
  name: 'Getting Started Application',
  scope: {
    read: 'true',
    write: 'true' },
  expiration: 'never',
  success: authenticationSuccess,
  error: authenticationFailure
   });
 });

  var myList = '597979b175403b5373c9ceaf';

 var creationSuccess = function (data) {
   console.log('Card created successfully.');
   console.log(JSON.stringify(data, null, 2));
 };

 var newCard = {
  name: 'New Test Card', 
  desc: 'This is the description of our new card.',
  // Place this card at the top of our list 
  idList: myList,
  pos: 'top'
};

window.Trello.post('/cards/', newCard, creationSuccess);
  
window.Trello.put('/cards/[ID]', {name: 'New Test Card'});
    </script>
</head>

<body>

</body>
</html>