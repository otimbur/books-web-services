<html>
<head>
<title>Bond Web Service Demo</title>
<style>
	body {font-family:georgia;}

  .book{
    border:1px solid #E77DC2;
    border-radius: 5px;
    padding: 5px;
    margin-bottom:5px;
    position:relative;   
  }
  img{
    width:100px;
    height:100px;
  }
 
  .pic{
    position:absolute;
    right:10px;
    top:10px;
  }
  
  
 
</style>
<script src="https://code.jquery.com/jquery-latest.js"></script>

<script type="text/javascript">

function booksTemplate(book){
  return`
      <div class="book">
      <b>Number</b>: ${book.Book} <br />
      <b>Title</b>: ${book.Title}<br />
      <b>Year</b>: ${book.Year} <br />
      <b>Author</b>: ${book.Author} <br /> 
      <b>Genre</b>: ${book.Genre} <br />
      <b>Raiting</b>: ${book.Raiting} <br />
      <b>Volume Sales</b>: ${book.VolumeSales} <br />
      <div class="pic"><img src="thumbnails/${book.Image}"/></div>
      </div>
  
  `;
}
        

$(document).ready(function() {  

	$('.category').click(function(e){
        e.preventDefault(); //stop default action of the link
		cat = $(this).attr("href");  //get category from URL

    var request = $.ajax({
       url: "api.php?cat=" + cat,
     method: "GET",
     dataType: "json"
   });
   request.done(function( data ) {
     console.log(data);

    $("#mytitle").html(data.title);

     $("#list").html("");

     $.each(data.book, function (i,item) {
       let myData = booksTemplate(item);
       $("<div></div>").html(myData).appendTo("#list");
       
       
     })
   });
     request.fail(function(xhr, status, error ) {
alert('Error - ' + xhr.status + ': ' + xhr.statusText);
   });
     
	});
});	


</script>
</head>
	<body>
	<h1>Best 10 books </h1>
		<a href="year" class="category">Best 10 books based on the year</a><br />
		<a href="box" class="category">Top 10 books based on sold copies</a>
		<h3 id="mytitle">Title Will Go Here</h3>
		<div id="list">
		</div>
		<div id="output">Results go here</div>
	</body>
</html>
