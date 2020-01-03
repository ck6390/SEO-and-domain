 $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true,
                
        });
    });
    $(document).ready(function() {
        $('#dataTables-example1').DataTable({
                responsive: true,
                
        });
       
    });
//Multi check 
     function checkAll(ele) {
     var checkboxes = document.getElementsByTagName('input');
     if (ele.checked) {
         for (var i = 0; i < checkboxes.length; i++) {
             if (checkboxes[i].type == 'checkbox') {
                 checkboxes[i].checked = true;
             }
         }
     } else {
         for (var i = 0; i < checkboxes.length; i++) {
             console.log(i)
             if (checkboxes[i].type == 'checkbox') {
                 checkboxes[i].checked = false;
             }
         }
     }
 }
//Remove Read only
$('input[type=submit]').click(function () {
  $('input[type=text]').removeAttr('readonly');
  $('input[type=date]').removeAttr('readonly');
  $("#update").removeAttr('disabled');
})

$("#submit").click(function(e)
{   
    var year = document.getElementById("year").value;
    var month = document.getElementById("month").value;
    document.getElementById("experience").value += year + " " + month;
});

//Character Length
var lenghtOfTitleCharacter=$("#title").val().length;
if(lenghtOfTitleCharacter!=0)
{
	 $("#textCount").text(lenghtOfTitleCharacter);
}
	
$("#title").on('keyup',function(){
          var charCount = $(this).val().length;
           $("#textCount").text(charCount);
           var smsCount="";
          var selectedLanguage=$('input[name=islang]:checked').val();
           if(selectedLanguage=="English")
           { 
                  smsCount=parseInt(((parseInt(charCount)-1)/65)+1);
           }
          else if(selectedLanguage=="Hindi")
           { 
           smsCount=parseInt(((parseInt(charCount)-1)/70)+1);    
           }
             $("#creditCount").text(smsCount);
       });
	   
//Character Length
var lenghtOfTitleCharacter=$("#metaDescription").val().length;
if(lenghtOfTitleCharacter!=0)
{
	 $("#textCountD").text(lenghtOfTitleCharacter);
}	   
	   $("#metaDescription").on('keyup',function(){
          var charCount = $(this).val().length;
           $("#textCountD").text(charCount);
		 
           var smsCount="";
          var selectedLanguage=$('input[name=islang]:checked').val();
           if(selectedLanguage=="English")
           { 
                  smsCount=parseInt(((parseInt(charCount)-1)/65)+1);
           }
          else if(selectedLanguage=="Hindi")
           { 
           smsCount=parseInt(((parseInt(charCount)-1)/70)+1);    
           }
             $("#creditCountD").text(smsCount);
       });