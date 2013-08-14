<!--<script src="js/jquery/jquery.tablesorter.min.js"></script>
<script >
  $(function() {
    $("table#sortTableExample").tablesorter({ sortList: [[1,0]] });
  });
</script> -->

<table class="table table-striped ">
        <thead>
          <tr>
            <th>Board Name</th>
            <th>Board Parent Tag</th>
            <th>Created By</th>
            <th>Created Date</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
            <?php if(is_array($boards) && !empty($boards)): 
                foreach ($boards as $val): ?>
          <tr>
            <td><?=$val->board_name?></td>
            <td><?=$val->parent_tags?></td>
            <td><?=$val->user_name?></td>
            <td><? echo date('d-m-Y',  strtotime($val->createdTime));?></td>
            <td><div class="btn-group"> <a href="<?php echo site_url('/admin/home/edit_board/'.$val->board_id) ?>"class="btn btn-primary"><i class="icon-edit icon-white"></i> Edit</a><a onclick="return confirm('Are you sure?')" href="<?php echo site_url('/admin/home/delete_board/'.$val->board_id) ?>"class="btn btn-danger"><i class="icon-trash icon-white"></i> Delete</a> </div></td>
          </tr>
          <? endforeach;endif;?>
        </tbody>
      </table>
</table>