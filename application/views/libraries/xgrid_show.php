<?php $gridid = uniqid('xgrid_') ?>

<script type="text/javascript">
    $.fn.xgrid = function() {
        var condition = {
            position: 0,
            component: null,
            neighbour: null,
            mx: 0
        }

        $(this).disableSelection();

    };

    $(function() {
        $('#<?php echo $gridid ?>').xgrid();

    });
</script>

<div class="grid-container">
    <table class="grid" id="<?php echo $gridid ?>">
        <tr class="grid-head-row">
            <th width="1"><input type="checkbox" class="grid_head" /></th>

            <?php foreach ($self->fields as $key => $field): ?>
                <th style="height: 30px;"><?php echo l(!empty($self->names[$key]) ? $self->names[$key] : humanize($field)) ?></th>
            <?php endforeach ?>
            <?php if (!empty($self->actions)): ?>
                <th style="width: 10px!important;">Edit/Delete</th>
            <?php endif ?>
        </tr>

        <?php if (empty($data)): ?>
            <tr class="grid-empty-row">
                <td colspan="<?php echo count($self->fields) + ( (empty($self->actions)) ? 1 : 2) ?>" style="text-align: center"><span><?php echo l('Datanya masih kosong.') ?></span></td>
            </tr>
        <?php else: ?>
            <?php foreach ($data as $row): ?>
                <tr data-ref="<?php echo $row['id'] ?>" class="grid_row">
                    <td width="1"><input type="checkbox" name="row[]" value="<?php echo $row['id'] ?>" class="grid_body" /></td>
                    <?php for ($i = 0; $i < count($self->fields); $i++): ?>
                    <td <?php echo (empty($self->aligns[$i])) ? '' : 'style="text-align:' . $self->aligns[$i] . '"' ?>>
                        <span style="<?php echo @$self->styles[$i] ?>"><?php echo highlight_phrase($self->format($row[$self->fields[$i]], $self->fields[$i], $row, $i), @$filter['q'], '<span class="highlight-phrase">', '</span>') ?></span></td>
                    <?php endfor ?>
                    <?php if (!empty($self->actions)): ?>
                        <td class="submenu">
                            <div class="container">
                                <?php foreach ($self->actions as $key => $action): ?>
                                <span class="<?php echo $key ?>" style="width: 10px!important; margin-left:2px;"><a class="grid-action" href="<?php echo site_url($action . '/' . $row['id']) ?>" title="<?php echo $key ?>"><?php echo l(humanize($key)) ?></a> </span>
                                <?php endforeach ?>
                            </div>
                        </td>
                    <?php endif ?>
                </tr>
            <?php endforeach ?>
        <?php endif ?>
    </table>

    <script type="text/javascript">
        $(function() {
            $("#<?php echo $gridid ?> .grid-action-cell").width($('.container').width() + 10);

            $("#<?php echo $gridid ?> .grid_head").click(function() {
                var checkers = $("#<?php echo $gridid ?> .grid_body").attr("checked", $(this).attr("checked")).trigger('change');
                try {
                    $.uniform.update(checkers);
                } catch(e) {}
            });

            $("#<?php echo $gridid ?> .grid_body").change(function() {
                if ($(this).attr("checked")) {
                    $(this).parents('tr').addClass('selected');
                } else {
                    $(this).parents('tr').removeClass('selected');
                }
            });

            $("#<?php echo $gridid ?> tr[data-ref] td:not(:first-child):not(:last-child)").dblclick(function(evt) {
                evt.preventDefault();
<?php
// FIXME ini harus diperbaiki secara framework, di bawah ini di-comment karena fungsionalitasnya tidak diinginkan
/* if (empty($self->dblclick_handler)): ?>
  window.location.href = '<?php echo site_url($CI->_get_uri('edit')) ?>/' + $(this).parent().attr('data-ref');
  <?php else: ?>
  window.location.href = '<?php echo $self->dblclick_handler ?>/' + $(this).parent().attr('data-ref');
  <?php endif */
?>
            return false;
        });

        $("#<?php echo $gridid ?> tr[data-ref] td:not(:first-child):not(:last-child)").click(function() {
            var checkers;
            checkers = $(this).parents('tbody').find('tr .grid_body').attr('checked', false).trigger('change');
            checkers = $(this).parent().find('.grid_body').attr('checked', true).trigger('change');
            try {
                $.uniform.update(checkers);
                $.uniform.update(checkers);
            } catch (e) {}
        });

        $("#<?php echo $gridid ?> tr[data-ref] td:not(:first-child):not(:last-child)").mousedown(function(evt) {
            if (evt.which == 3) {
                var x = $(this).parent().find('.grid_body');
                if (!x.attr('checked')) {
                    var checkers;
                    checkers = $(this).parents('tbody').find('tr .grid_body').attr('checked', false).trigger('change');
                    checkers = $(this).parent().find('.grid_body').attr('checked', true).trigger('change');
                    try {
                        $.uniform.update(checkers);
                        $.uniform.update(checkers);
                    } catch (e) {}
                }
            }
        });
    });
    </script>

    <?php // echo $self->context_menu->show('#' . $gridid . ' tr[data-ref]') ?>
</div>
