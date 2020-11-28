$(document).ready(function(e) {
    let options_obj = {
        current_state : {
            res_dispo : false,
            option_name : ''
        },

        init : function(e) {
            this.clickOption()
            this.subRes()
        },

        clickOption : function(e) {
            let obj = options_obj
            $("#options a").on('click', function(e){
                e.preventDefault()
                let $this = $(this)
               let $href = $this.attr('href')
               let url = '/fokontany/'+$href
               obj.current_state.option_name = $href
                $.get(url)
                    .done(function(data, text, jqXhr){
                        obj.res_dispo = true
                        $('#result-options').html(jqXhr.responseText)
                    })
                    .fail(function(jqXhr){
        
                    })
                    .always(function(){
        
                    })
            })
        },
        
        subRes : function() {
            // res top fokontany longer name
            
            $("#top").on("focus", function(e) {
                console.log('bonjour')
                $("#topForm").on('submit', function(e) {
                    e.preventDefault()
                    let $this_top = $(this)
                    let top_url = '/fokontany/TopFktnMostRepeated'
                    $.post(top_url, $this_top.serializeArray())
                        .done(function(data, text, jqXhr) {
                            $('#result-options').html(jqXhr.responseText)
                        })
                        .fail(function(jqXhr){})
                        .always(function(){})
                })
            })
        }
    }

    options_obj.init()
   
})