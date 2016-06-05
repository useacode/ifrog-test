var app = {
	init: function(){
		this.initDialog();

		this.showDialog();

		this.showHidden();

		this.addNameClick();

		this.deleteNameClick();

		app.getNames();
	},

	initDialog: function(){
		$("#dialog").dialog({
			modal:true,
			autoOpen: false,
		    buttons: [
		        {
		            text: "Ok",
		            click: function() {
		            	if(/^[а-яА-ЯёЁa-zA-Z]+$/.test($('#name').val())){
							$('#page_title').text($('#name').val());
							$( this ).dialog( "close");
						}          			        
		            }
		        },
		        {
		            text: "Закрыть",
		            click: function() {
		                $( this ).dialog( "close" );
		            }
		        }
		    ]
		});
	},

	showDialog: function(){
		$('#show-dialog').click(function() {
			$('#name').val('');
			$('#dialog').dialog("open");
		});
	},

	showHidden: function(){
		$('#show-hidden').click(function() {
			$('#hidden-input').attr("type", "text");
			$('label[for="hidden-input"]').show();
			$("#add-name").prop("disabled", false);
		});
	},

	addNameClick: function(){
		$('#add-name').click(function() {
			if(/^[а-яА-ЯёЁa-zA-Z]+$/.test($('#hidden-input').val())){
				app.addName($('#hidden-input').val());
				$('#hidden-input').val('');
			}
			else{
				alert("Введите имя");
			}
			
		});
	},

	deleteNameClick: function(){
		$('#names').on("click", ".delete", function() {
			var id = $(this).parent().data("id");
			$.post("/ajax/deletename.php", {id: id}, function(data){
				app.getNames();
			});
			
		});
	},

	getNames: function(){
		$.get("/ajax/getnames.php", function(data){
			$("#names > *").remove();
			for(var i = 0; i < data.length; i++){ 
				$("#names").append("<li data-id='" + data[i]["id"] + "'>" + data[i]["name"] + "<button class='delete'>Удалить</button></li>");
			}
		}, "json");
	},

	addName: function(name){
		$.post("/ajax/addname.php", {name: name}, function(data){
			app.getNames();
		});
	}
}


$(function() {
	app.init();
});