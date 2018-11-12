$(function () {
    $(document).ready(function () {
        $('body')
        /*Modal*/
        .on('click','a.default',function (event) {
            event.preventDefault();
            $("#yezz-modal .modal-content").empty();
            if ($(this).attr("modal-url")){
                $("#yezz-modal .modal-content").load($(this).attr("modal-url"));
            }else if($(this).attr("modal-text")){
                $("#yezz-modal .modal-content").html($(this).attr("modal-text"));
            }
        })
        .on('click','a.secundary',function (event) {
            event.preventDefault();
            $("#yezz-modal-secundary .modal-content").empty();
            if ($(this).attr("modal-url")){
                $("#yezz-modal-secundary .modal-content").load($(this).attr("modal-url"));
            }else if($(this).attr("modal-text")){
                $("#yezz-modal-secundary .modal-content").html($(this).attr("modal-text"));
            }
        })
        /*Animación para clonar*/
        .on('click','.clone-content',function (event) {
            event.preventDefault();
            var content=$(this).attr("clone-content")?$($(this).attr("clone-content")):($(this).attr("content")?$(this).parents($(this).attr("content")):null);
            if (!content || !$(content).length){                 
                return;
            }

            /*Se realiza la copia*/
            var clon=$(content).clone();

            /**
             *  Opcional -> Limpiar inputs internos 
             *  <element class="clone-content" clear-input="any"></element>
             */
            if ($(this).attr("clear-input")){
                $(clon).find('input').val('');
                $(clon).find('select').val('');
                $(clon).find('textarea').empty();
                $(clon).find('input[type="radio"]').removeAttr('checked').removeProp('checked');
                $(clon).find('input[type="checkbox"]').removeAttr('checked').removeProp('checked');
            }

            /**
             *  Opcional -> Remover atributos del clon 
             *  <element class="clone-content" remove-attr="attr1,attr2,nAttr"></element>
             */
            if ($(this).attr("remove-attr")){
                var attrs=$(this).attr("remove-attr").split(',');
                $.each(attrs,function (index,element) {
                    $(clon).removeAttr(element);
                });
            }

            /**
             *  Opcional -> Agregar atributos al clon 
             *  <element class="clone-content" add-attr="attr1:value,attr2:value,nAttr:value"></element>
             */
            if ($(this).attr("add-attr")){
                var attrs=$(this).attr("add-attr").split(',');
                $.each(attrs,function (index,element) {
                    var a=element.split(':');
                    if (a.length==2){
                        $(clon).attr(a[0],a[1]);
                    }
                });
            }

            /**
             *  Opcional -> Remover atributos de un elemento interno del clon 
             *  <element class="clone-content" remove-element-attr="element1:attr,element2:attr,nElement:attr"></element>
             */
            if ($(this).attr("remove-element-attr")){
                var attrs=$(this).attr("remove-element-attr").split(',');
                $.each(attrs,function (index,element) {
                    var a=element.split(':');
                    if (a.length==2){
                        $(clon).find(a[0]).removeAttr(a[1]);
                    }
                });
            }

            /**
             *  Opcional -> Agregar atributo a un elemento interno del clon 
             *  <element class="clone-content" add-element-attr="element::attr:value,element2::attr:value,nElement::attr:value"></element>
             */
            if ($(this).attr("add-element-attr")){
                var attrs=$(this).attr("add-element-attr").split(',');
                $.each(attrs,function (index,element) {
                    var e=element.split('::');
                    if (e.length==2){
                        var a=e[1].split(':');
                        if (a.length==2){
                            $(clon).find(e[0]).attr(a[0],a[1]);
                        }
                    }
                });
            }

            /**
             *  Opcional -> Remover classe del clon 
             *  <element class="clone-content" remove-class="class1,class2,nClass"></element>
             */
            if ($(this).attr("remove-class")){
                var classs=$(this).attr("remove-class").split(',');
                $.each(classs,function (index,element) {
                    $(clon).removeClass(element);
                });
            }


            /**
             *  Opcional -> Agregar clases al clon 
             *  <element class="clone-content" add-class="class1,class2,nClass"></element>
             */
            if ($(this).attr("add-class")){
                var classs=$(this).attr("add-class").split(',');
                $.each(classs,function (index,element) {
                    $(clon).addClass(element);
                });
            }

            /**
             *  Opcional -> Remover classe de un elemento interno del clon 
             *  <element class="clone-content" remove-element-class="element:class,element2:class,nElement:class"></element>
             */
            if ($(this).attr("remove-element-class")){
                var classs=$(this).attr("remove-element-class").split(',');
                $.each(classs,function (index,element) {
                    var c=element.split(":");
                    if (c.length==2){
                        $(clon).find(c[0]).removeClass(c[1]);
                    }
                });
            }

            /**
             *  Opcional -> Remover classe de un elemento interno del clon 
             *  <element class="clone-content" add-element-class="element:class,element2:class,nElement:class"></element>
             */
            if ($(this).attr("add-element-class")){
                var classs=$(this).attr("add-element-class").split(',');
                $.each(classs,function (index,element) {
                    var c=element.split(":");
                    if (c.length==2){
                        $(clon).find(c[0]).addClass(c[1]);
                    }
                });
            }

            /**
             *  Opcional -> Remover elemento interno del clon 
             *  <element class="clone-content" remove-element="element,element2,nElement"></element>
             */
            if ($(this).attr("remove-element")){
                var elements=$(this).attr("remove-element").split(',');
                $.each(elements,function (index,element) {
                    $(clon).find(element).remove();
                });
            }

            /**
             *  Opcional -> Add contenido al clon 
             *  <element class="clone-content" add-content="any content"></element>
             */
            if ($(this).attr("add-content")){
                $(clon).html($(this).attr("add-content"));
            }

            /**
             *  Opcional -> Add contenido a un elemento del clon 
             *  <element class="clone-content" add-element-content="any content" elements="element1,element2" [delimite-content="symbol-demilite"|optional]></element>
             */
            if ($(this).attr("add-element-content") && $(this).attr("elements")){
                var elements=$(this).attr("elements").split(',');
                var contents=$(this).attr("add-element-content");
                if ($(this).attr("delimite-content")){
                    contents=contents.split($(this).attr("delimite-content"));
                }                
                $.each(elements,function (index,element) {
                    if (Array.isArray(contents)){
                        $(clon).find(element).html(contents[index]?contents[index]:contents[contents.length]);
                    }else{
                        $(clon).find(element).html(contents);
                    }
                });                
            }


            $(content).after(clon);

            /**
             *  Opcional -> Remover contenedor original 
             *  <element class="clone-content" remove-content="any"></element>
             */
            if ($(this).attr("remove-content")){
                $(content).remove();
            }
        })
        /*Animación para clonar*/
        .on('click','.remove-content',function (event) {
            event.preventDefault();
            var content=$(this).attr("remove-content")?$($(this).attr("remove-content")):($(this).attr("content")?$(this).parents($(this).attr("content")):null);
            if (!content || !$(content).length){                 
                return;
            }
            $(content).remove();
        });

        /*Inputs y otros elementos con plugins*/
        setTimeout(function () {
            /*Todos los daterpiker del sitio*/
            if ($('input.datepicker').length){
                var inputs=$('input.datepicker');
                $.each(inputs,function (index,element) {
                    var input=$(element).pickadate();
                    var picker=input.pickadate('picker');
                    picker.set('select', $(element).val(), { format: 'yyyy-mm-dd' })
                });
            }

            /*Cargar select2*/
            if ($('input.typeahead').length){
                var $typeahead = $('.typeahead'),source=[];
                var $typeaheadSource=$typeahead.next('.typeahead-source');
                if ($typeaheadSource.length){
                    var i=0;
                    $.each($typeaheadSource.find('span'),function (index,element) {
                        var text=$(element).text();
                        source[i++]={id: text.toLowerCase().replace(" ",""), name: text};
                    });
                    $typeaheadSource.remove();
                }
                $typeahead.typeahead({
                    source:source, 
                    autoSelect: true
                });

                // $.each($('select.select2-active'),function (index,element) {
                    // var div=$(element).parents('div.select-wrapper');
                    // div.before(element);
                    // div.remove();
                    // var select=$(element).parents('div.select-wrapper').next('select');
                    // $(element).parents('div.select-wrapper').remove();
                    // $(element).select2();
                // });                
            }
        },1000);


        /*Upload file del sitio*/
        $('.dropify').dropify({
            messages: {
                'default': 'Click o Arrasta y suelta un archivo aquí',
                'replace': 'Click o Arrasta y suelta un archivo aquí para remplazar',
                'remove':  'Remover',
                'error':   'Ooops, Algo va mal.'
            },error: {
                'fileSize': 'El tamaño del archivo de demasiado grande ({{ value }} max).',
                'minWidth': 'El ancho de la imagen de demasiado pequeño ({{ value }}}px min).',
                'maxWidth': 'El ancho de la imagen de demasiado grande ({{ value }}}px max).',
                'minHeight': 'El alto de la imagen de demasiado pequeño ({{ value }}}px min).',
                'maxHeight': 'El alto de la imagen de demasiado grande ({{ value }}px max).',
                'imageFormat': 'El formato de la imagen no está permitido (solamente {{ value }}).'
            }
        });
        $('.modal').modal();
        $('select').material_select();
        $(".button-collapse").sideNav();
    });
})