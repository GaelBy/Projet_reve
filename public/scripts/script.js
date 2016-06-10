$('document').ready(function()
{
	$('#ajax').keyup(function(info)
	{
		var contenu = $(this).val();
		$('.affichage').load('index.php?page=search_result&ajax&search='+contenu);
	});
});