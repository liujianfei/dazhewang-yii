<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<table>
    <tbody>
        <?php $c=0; foreach ($resources as $key=>$value) : ?>
        <tr class="<?php echo ($c%2?'odd':'even') ?>">
            <th nowrap="nowrap"><?php echo $key; ?></th>
            <td><?php echo $value; ?></td>
        </tr>
        <?php ++$c; endforeach;?>
    </tbody>
</table>

<script type="text/javascript">
/*$(function(){
    $('#<?php echo $this->id?>').show();
});*/
</script>