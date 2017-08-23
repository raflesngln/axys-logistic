 
 function ColVisCustom(a){
            e = new $.fn.dataTable.ColVis(a, {
                    buttonText: "Select columns",
                    exclude: [0],
                    restore: "Restore",
                    showAll: "Show all",
                    showNone: "Show none"
                }),
                i = $(e.dom.button).off("click").attr("class", "md-btn md-btn-colVis"),
                l = $('<div class="uk-button-dropdown uk-text-left" data-uk-dropdown="{mode:\'click\'}"/>').append(i),
                o = $('<div class="md-colVis uk-text-right"/>').append(l),
                d = $(e.dom.collection);
            $(d).attr({
                "class": "md-list-inputs",
                style: ""
            }).find("input").each(function(t) {
                var a = $(this).clone().hide();
                $(this).attr({
                    "class": "data-md-icheck",
                    id: "col_" + t
                }).css({
                    "float": "left"
                }).before(a)
            }).end().find("span").unwrap().each(function() {
                var t = $(this).text(),
                    a = $(this).prev("input").attr("id");
                $(this).after('<label for="' + a + '">' + t + "</label>").end()
            }).remove();
            var n = $('<div class="uk-dropdown uk-dropdown-flip"/>').append(d);
            l.append(n), t.closest(".dt-uikit").find(".dt-uikit-header").before(o), altair_md.checkbox_radio(), t.closest(".dt-uikit").find(".md-colVis .data-md-icheck").on("ifClicked", function() {
                $(this).closest("li").click()
            }), t.closest(".dt-uikit").find(".md-colVis .ColVis_ShowAll,.md-colVis .ColVis_Restore").on("click", function() {
                $(this).closest(".uk-dropdown").find(".data-md-icheck").prop("checked", !0).iCheck("update")
            }), t.closest(".dt-uikit").find(".md-colVis .ColVis_ShowNone").on("click", function() {
                $(this).closest(".uk-dropdown").find(".data-md-icheck").prop("checked", !1).iCheck("update")
            })
 }