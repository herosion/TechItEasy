var f = []; // global functions
var l = []; // events listeners


f.loadCategoryDeleteModal = function() {
	var categoryId        = $(this).data('id');
	var categoryUrlDelete = $(this).data('urldelete');
	$('#category-name-delete').html($('#category-name-' + categoryId).html());
	$('#category-delete-form').attr('action', categoryUrlDelete);
};

$('.btn-delete-category').on('click', f.loadCategoryDeleteModal);

$("#addReponse").on('click', function () {
    var nbRep = parseInt($("#nbReponseText").text(), 10);
    $(".form-group").append('<div class="margin-bottom answer input-group">' +
            '<span class="input-group-addon">' +
            '<input type="radio" name="answer" value="' + nbRep + '">' +
            '</span>' +
            '<input id="answer' + nbRep + '" type="text" class="form-control" placeholder="Réponce '+parseInt(nbRep+1,10)+'"/>' + '\
</div>');
    $("#nbReponseText").html(nbRep + 1);
    $("#nbReponse").val(nbRep + 1);
});


$("#removeReponse").on('click', function () {
    var nbRep = parseInt($("#nbReponseText").text(), 10);
    if (nbRep > 0) {
        $(".answer").last().remove();
        $("#nbReponseText").html(nbRep - 1);
        $("#nbReponse").val(nbRep - 1);
    }
});
//# sourceMappingURL=admin.js.map



/*-------Filtre et sorting------- */
var dynatable = $('#mytable').dynatable({

    features: {
      paginate: false,
      recordCount: false,
      sorting: true,
      search: false    }
  }).data('dynatable');

$('#search-category').change( function() {
    var value = $(this).val();
    if (value === "Filtrer par catégorie") {
      dynatable.queries.remove("catégorie");
    } else {
        dynatable.queries.add("catégorie", value);
    }
    dynatable.process();
  });

$('#search-difficulte').change( function() {
    var value = $(this).val();
    if (value === "Filtrer par difficulté") {
      dynatable.queries.remove("difficulté");
    }else if(value === "Débutant"){
        console.log(value);
        value = 1;
        dynatable.queries.add("difficulté", value);
    }else if(value === "Intermédiare"){
        console.log(value);
        value = 2;
        dynatable.queries.add("difficulté", value);
    }else {
        console.log(value);
        value = 3;
        dynatable.queries.add("difficulté", value);
    }
    dynatable.process();
  });

var dynatable2 = $('#mytable2').dynatable({
    features: {
      paginate: false,
      recordCount: false,
      sorting: true,
      search: true
    }
  }).data('dynatable');

$('#search-category, #search-difficulte, #search-category2').on('click', function () {
    $('.filtre').hide();
});

    
$('#dynatable-query-search-mytable2').addClass('btn btn-extia').css('marginBottom', '20px');

$('#dynatable-search-mytable2').css('marginLeft', '30px');

$("#eraseFiltre").on('click', function () {
    location.reload();
});


/*$('.suppression-badge').on('click', function () {
    var url = $(this).data('url');
    var id = $(this).data('id');
    //var CSRF_TOKEN = $('#csrf').attr('value');

    console.log('testssssss');
    console.log(id);

    
});
*/

//Suppression questions, questionnaires
$(".suppression-badge").on('click', function () {
    
    $(this).each(function(){

        var url = $(this).data('url');
        $("#delete-form").attr('action', url);
    });
});

$('.ok').on('click', function(){  
   $("#delete-form").attr('action', url);
});
  
/*var dynatable3 = $('#mytable3').dynatable({
    features: {
      paginate: false,
      recordCount: false,
      sorting: false,
      search: false
    }
  }).data('dynatable');

$('#search-category2').change( function() {
    var value = $(this).val();
    if (value === "Filtrer par catégorie") {
      dynatable3.queries.remove("catégorie");
    } else {
        dynatable3.queries.add("catégorie", value);
    }
    dynatable3.process();
  });*/



//Ajout des questions à un questionnaire
var t = [];
var te = [];

$('#mytable3 > tbody > tr').each(function() {
    te = t.push($(this).data('t'));
});
$('#addQuestions').on('click', function() {
    $('#mytable4 input').each(function() {
        var id = $(this).data('id');
        var href = $(this).data('href');
        var cat = $(this).data('cat');
        var lvl = $(this).data('lvl');
        var label = $(this).data('label');
        var descri = $(this).data('des');

        if ($(this).is(':checked')) { 
            if ($.inArray(id, t) == -1) {
                
                var newQues = $('#mytable3 > tbody:last').append(
                    '<tr id="sp-'+id+'" data-t="'+id+'">'+
                    '<td>'+id+'</td>'+
                    '<td>'+cat+'</td>'+
                    '<td>'+label+'</td>'+
                    '<td>'+descri+'</td>'+
                    '<td>'+lvl+'</td>'+
                    '<td><a class="question-badge edition-badge" href='+href+'> <i class="fa fa-eye"></i></a></td>'+
                    '</tr>').fadeIn(1000);

                t.push(id);
            }
        }else{

            if ($.inArray(id, t) != -1) {
               $('#sp-'+id).remove();
               t.splice(t.indexOf(id),1);
            }
        }
    });
    $('#myModalQuestions').modal('hide');
});

//Ajout des questions à la modale en fonction catégorie questionnaire
var catQ = [];

$('#cat-table input').each(function() {
    if ($(this).is(':checked')) {
        catQ.push($(this).attr('value')); //récupère tab
    }
});

$('#addQ').on('click', function() {

});














/*
$(".suppression-badge").on('click', function () {
    var url = $(this).data('url');
    var CSRF_TOKEN = $('#csrf').attr('value');

    console.log(url);
    
    var aJax = $.ajax({
        type: "POST",
        url: url + '/test',
        dataType: 'JSON',
        data: {_token: CSRF_TOKEN}
    })
            .done(function (response) {
                if (response.data) {
                    $("#delete-text").text("êtes vous sure de vouloir supprimer cette question?");
                    $("#delete-btn").attr("disabled", false);
                } else {
                    $("#delete-text").text("Impossible de supprimer cette question, elle est utilisée dans des un questionnaire");
                    $("#delete-btn").attr("disabled", true);
                }
            })
            .fail(function () {
                alert("error");
            });
    $("#delete-form").attr('action', url);
});*/