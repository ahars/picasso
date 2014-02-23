$(document).ready(function() {
    var m_date = "Une semaine valide est requise. Au format YYYY-W."
        , r_date = /^(\d){4}-W(\d){2}$/      
        , m_time = "Une heure valide est requise. Au format HH:MM:SS."
        , m_not_time = "Une heure valide est requise. 00 < heure < 24 , 00 < min | sec < 59. "
        , r_time = /^(\d){2}:(\d){2}:(\d){2}$/
        , m_varchar = "Caractères alphanumériques accentués seulement.\nAu minimum 2 caractères."
        , r_varchar = /^[a-zA-Z0-9 '"-_°éèàâêîôûäëïöüçœ()\[\]{}]{2,255}$/
        , m_email = "Une adresse email valide est requise."
        , r_email = /^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$/
        , m_tel = "Un numéro de téléphone valide est requis. Chiffres pas d'éspaces."
        , r_tel = /^0[1234567](\d{2}){4}$/
        , m_number = "Un nombre positif est requis."
        , r_number = /^[\-\+]?[0-9]*(\.[0-9]+)?$/;

    var tmp = new Array();
    tmp['goodies'] ='<tr class="goodies-{{id}}">'+
                    '<td>{{semaine}}</td>'+
                    '<td>{{numero}}</td>'+
                    '<td>{{nom}}</td>'+
                    '<td>{{prenom}}</td>'+
                    '<td><a class="editable" href="edit-goodies-{{id}}"><span class="glyphicon glyphicon-pencil"></span></a></td>'+
                    '<td><a class="deletable" href="delete-goodies-{{id}}"><span class="glyphicon glyphicon-trash"></span></a></td></tr>';

    tmp['bieres'] = '<tr class="bieres-{{id}}">'+
                    '<td class="small"><input type="checkbox" name="disabled" {{#disabled}}checked{{/disabled}}></td> '+
                    '<td>{{semaine}}</td>'+
                    '<td>{{nom}}</td>'+
                    '<td>{{category}}</td>'+
                    '<td>{{prix}}</td>'+
                    '<td>{{degre}}</td>'+
                    '<td><a class="editable" href="edit-bieres-{{id}}"><span class="glyphicon glyphicon-pencil"></span></a></td>'+
                    '<td><a class="deletable" href="delete-bieres-{{id}}"><span class="glyphicon glyphicon-trash"></span></a></td></tr>';

    tmp['snacks'] = '<tr class="snacks-{{id}}">'+
                    '<td class="small"><input type="checkbox" name="disabled" {{#disabled}}checked{{/disabled}}></td> '+
                    '<td>{{nom}}</td>'+
                    '<td>{{prix}}</td>'+
                    '<td><a class="editable" href="edit-snacks-{{id}}"><span class="glyphicon glyphicon-pencil"></span></a></td>'+
                    '<td><a class="deletable" href="delete-snacks-{{id}}"><span class="glyphicon glyphicon-trash"></span></a></td></tr>';

    tmp['softs'] =  '<tr class="softs-{{id}}">'+
                    '<td class="small"><input type="checkbox" name="disabled" {{#disabled}}checked{{/disabled}}></td> '+
                    '<td>{{nom}}</td>'+
                    '<td>{{prix}}</td>'+
                    '<td><a class="editable" href="edit-softs-{{id}}"><span class="glyphicon glyphicon-pencil"></span></a></td>'+
                    '<td><a class="deletable" href="delete-softs-{{id}}"><span class="glyphicon glyphicon-trash"></span></a></td></tr>';

    tmp['users'] =  '<tr class="users-{{login}}">'+
                    '<td>{{login}}</td>'+
                    '<td><a class="editable" href="edit-users-{{login}}"><span class="glyphicon glyphicon-pencil"></span></a></td>'+
                    '<td><a class="deletable" href="delete-users-{{login}}"><span class="glyphicon glyphicon-trash"></span></a></td></tr>';
   
    $('.form-horizontal').ajaxForm({
        dataType: 'json',
        beforeSubmit: function(array,$form,o){
            var main_error = false;
            o.url = 'admin/add-'+$form.attr('action');

            $form.find('input').map(function(){
                var type = $(this).attr('type'),
                    val = $(this).val(),
                    isRequired = ($(this).attr('required')=="required")? true : false ,
                    error = false;

                if(isRequired){
                    switch (type) {
                        case "text":
                            if(!val.match(r_varchar)){
                                error = true;
                                main_error = true;
                                msg = m_varchar;
                            }
                            if(val=="Description")
                                val = "";
                            break;
                        case "number":
                            if(!val.match(r_number)){
                                error = true;
                                main_error = true;
                                msg = m_number;
                            }
                            break;
                        case "week":
                            if(!val.match(r_date)){
                                error = true;
                                main_error = true;
                                msg = m_date;
                            }
                            break;
                        case "checkbox":
                            if(val != "0" && val != "1"){
                                error = true;
                                main_error = true;
                                msg = "0/1";
                            }
                            break;
                        default: 
                            console.log("catch type : "+type+" : "+val);
                            break;
                    }
                }else{
                    if(val == "")
                        $(this).removeAttr('name');
                }
                if(error){
                    $(this).parents('.form-group').removeClass('has-success').addClass('has-error');
                    console.log(msg);
                }else{
                    $(this).parents('.form-group').removeClass('has-error').addClass('has-success'); 
                }

            });

            if(main_error){
                return false;
            }
        },
        success: function (json, status, xhr, $form){
            if(json.isUpdate){
                $('.'+$form.attr('action')).remove();
                delete json.isUpdate;
                $form.attr('action',$form.attr('action').toString().split('-')[0]);
                $form.find('[type="hidden"]').remove();
            }
            $('#'+$form.attr('action')+' .section tbody').prepend(Mustache.render(tmp[$form.attr('action')],json));
            $form.clearForm();
        }
    });

    $('#checkbox-biere').change(function(event){
        if($(this).is(":checked")){
            $(this).parents('form').find('#inputSemaine').removeClass('hide');
        }else{
            $(this).parents('form').find('#inputSemaine').addClass('hide');
        }
    });

    $('tbody').on('click', '.editable', function (event){
        event.preventDefault();
        $.getJSON("admin/"+$(this).attr('href'),function(json){
            $.each(json[0], function(key, value){
                var $ctrl = $('#navbar-'+json.action+' [name="data['+key+']"]');
                switch($ctrl.attr("type")){
                    case "text" :   
                    case "hidden":  
                    case "textarea":  
                    case "week":
                    case "number":
                        $ctrl.val(value);
                        break;
                    case "radio" : case "checkbox":
                        $ctrl.each(function(){
                            if($(this).attr('value') == value) {  $(this).attr("checked",value); }
                        });
                    break;
                }
            });
            $('#navbar-'+json.action).append('<input type="hidden" name="data[id]" value="'+json[0].id+'" >');
            $('#navbar-'+json.action).attr('action',$('#navbar-'+json.action).attr('action')+'-'+json[0].id);
        });
    });

    $('tbody').on('click', '.deletable', function (event){
        event.preventDefault();
        $.getJSON("admin/"+$(this).attr('href'),function(json){
            $('.'+json.action+'-'+json.id).remove();
        });
    });

    $('[type="reset"]').on('click',function (event){
        $(this).parents('form').clearForm();
        $(this).parents('form').attr('action',$(this).parents('form').attr('action').split('-')[0]);
        $(this).parents('form').find('.form-group').removeClass('has-success').removeClass('has-error');
        $(this).parents('form').find('[type="hidden"]').remove();
    });

    $('.paginable').each(function(index){
        var rowCount = 0
            , pageSize = 10
            , pageIndex = 1
            , pages = 0
            , id = $(this).parents('.row').attr('id');

        $rows = $(this).find('tbody tr');
        $paging = $(this).find('.pagination');
        rowCount = $rows.length;
        pages = Math.ceil(rowCount / pageSize);

        if(pages<=10){
          for ( var i=1; i <= pages; i++){
            $paging.append('<li><a href="#page-'+id+'-'+i+'">'+i+'</a></li>');
          }
        }else{
            $paging.append('<li><a href="#page-'+id+'-1">1</a></li>');
        }
        
        $paging.on('click','a',function (event){
            event.preventDefault();
            if($(this).parent().hasClass('disabled'))
                return false;
            pageIndex = $(this).attr('href').split('-')[2];

            var current = (pageSize * (pageIndex - 1))
                , next = (current + pageSize < rowCount) ? current + pageSize : rowCount;

            $paging = $(this).parents('.pagination');
            $rows = $(this).parents('.paginable').find('tbody tr');

            if(pages<=10){
                $paging.find("li").each(function(index){
                    if(index == pageIndex-1)
                        $(this).addClass("active");
                    else
                        $(this).removeClass("active");
                });
            } else {
                posCurrent = 3;

                if(pageIndex<3)
                  posCurrent = pageIndex;

                start = (pageIndex - 3 < 0) ? 0 : pageIndex - 3;

                if(start + 5 < pages) {
                  end = start + 6;
                } else {
                  start = pages - 5;
                  end = pages + 1;
                  posCurrent = 5 - (pages - pageIndex);
                }

                if(start == 0)
                    $paging.html('<li><a href="#page-'+id+'-'+(start-1)+'">' + '<<' + '</a></li>');
                else
                    $paging.html('<li><a href="#page-'+id+'-'+start+'">'+start+'</a></li>');

                for ( var i=start+1; i < end; i++){
                    $paging.append('<li><a href="#page-'+id+'-'+i+'">'+i+'</a></li>');
                }

                if(end>pages)
                    $paging.append('<li><a href="#page-'+id+'-'+(end+1)+'">' + '>>' + '</a></li>');
                else
                    $paging.append('<li><a href="#page-'+id+'-'+end+'">'+end+'</a></li>');

                $paging.find("li").each(function(index){
                    if(index == posCurrent)
                        $(this).addClass("active");
                    else if(index <= 0)
                        $(this).addClass("disabled");
                    else if(index >= pages)
                        $(this).addClass("disabled");
                    else
                        $(this).removeClass("disabled").removeClass("active");
                });
            }
            $rows.each(function(index){
                index = current + index;

                if(index >= current && index < next)
                    $(this).show();
                else 
                    $(this).hide();
            });
            $('a[href=#'+id+']').trigger('click');
        });
        $paging.find('a').first().trigger('click');
    });

});
