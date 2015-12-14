<!-- Modal -->
<style>
    .modal-body {
        overflow: auto;
        max-height: 450px;
    }
    .tag {
        font-size: 10px;
        padding: .3em .4em .4em;
        margin: .3em .1em;
    }
    .tag a {
        color: #bbb;
        cursor: pointer;
        opacity: 0.6;

    }
    .tag a:hover {
        opacity: 1.0
    }
    .tag .remove {
        vertical-align: bottom;
        top: 0;
    }
    .tag a {
        margin: 0 0 0 .3em;
    }
    .tag a .glyphicon-white {
        color: #fff;
        margin-bottom: 2px;
    }
    .label {
        display: inline-block;
    }
</style>
<script type="text/javascript">
    $(document).ready(function()
    {
        var $modelData = {People:[], Companies:[], Products:[], Vertical:[], Events:[]};
        var $selectedContainer = "", $parentOwner, $objects = ["Companies", "People", "Vertical", "Products", "Events"];

        $('#customModal').on('show.bs.modal', function (e) {
            $title = $(e.relatedTarget).attr('data-title');
            $(this).find('.modal-title').text($title);
            $(this).find('.modal-body p').text("");
            $selectedContainer =  $(e.relatedTarget).attr('data-result-container');
            $parentOwner = $(e.relatedTarget).attr('data-parent-resource');
            $.each($objects, function(oIndex, oItem){
                $modelData[oItem] = [];
                $.each($("#" + $selectedContainer).find('input[type="hidden"]'), function(bIndex, bItem) {
                    if ($(bItem).attr("name").indexOf(oItem) == 0) {
                        $modelData[oItem].push({name: $(bItem).attr("name"), label:$(bItem).parent().text()})
                    }
                });
            })
            $data = JSON.parse($(e.relatedTarget).attr('modal-data'));

            if ($data.length) {
                $.each($data, function(index, value) {
                    if (value instanceof  Object) {
                        var $nameItem = $parentOwner +"_"+ value.id;
                        var found = _.find($modelData[$parentOwner], function (itemObject) {
                            return itemObject.name === $nameItem;
                        });
                        $('.modal-body p').append("<div><label><input type='checkbox' name='"+ $nameItem +"' " + (found ? "checked" : "" )+ ">" + value.description + "</label></div>");
                    }
                });
            }
            else {
                $(this).find('.modal-body p').text("No data for selection.");
            }


        });

        <!-- Form confirm (yes/ok) handler, submits form -->
        $('#customModal').find('.modal-footer #confirm').on('click', function () {
            $modelData[$parentOwner] = [];
            $.each($('.modal-body').find('input:checked'), function(index, item) {
                $modelData[$parentOwner].push({name:$(item).attr("name"), label:$(item).parent().text()})
            });

            $("#customModal").modal('hide');
        });
        $('#customModal').on('hide.bs.modal', function(e) {
            $('.modal-body p').text("");
            $('#'+$selectedContainer).text("");
            $.each($objects, function(index, oItem){
                $.each($modelData[oItem], function(index, item) {
                    $('#'+$selectedContainer).append("<label class='tag label label-primary'><span>"+ item.label + "</span>"
                            + "<input type='hidden' name='" + item.name +"' value='on'>"
                            +"<a><i class='remove glyphicon glyphicon-remove-sign glyphicon-white'></i></a></label>");
                });
            })
        });
    });
</script>
<div class="modal fade" id="customModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div class="modal-title">Attached to(object name):<span id="objectParent"></span></div>
            </div>
            <div class="modal-body" id="modelBody">
                <p></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal" value"Cancel">Cancel</button>
                <button type="button" class="btn btn-success" id="confirm" value"Select">Select</button>
            </div>
        </div>

    </div>
</div>