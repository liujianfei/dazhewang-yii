<div class="pageHeader" style="<?php echo $this->panleStyle; ?>">
    <form onsubmit="return navTabSearch(this);" rel="pagerForm" action="<?php echo $this->controller->createUrl($this->searchSubmit) ?>" method="post">
        <div class="searchBar">
            <table class="searchContent">
                <tr>
                <?php $index = 0; foreach ($this->searchCondition as $key=>$val): ?>
                <?php
                if ($index === $this->lineSpace) return;
                ?>
                <td><?php echo $key; ?></td>
                <td>
                    <?php if (strtolower($val['type']) == 'text'): ?>
                    <input type="text" name="<?php echo $val['name']; ?>" <?php echo isset($val['defaultValue']) ? "value=\"{$val['defaultValue']}\"" : '';
                        echo isset($val['class']) ? "class=\"{$val['class']}\"" : ""; echo isset($val['style']) ? "style=\"{$val['style']}\"" : ""; echo isset($val['alt']) ? "alt=\"{$val['alt']}\"" : ""; ?> />
                    <?php elseif(strtolower($val['type']) == 'select'): ?>
                    <select name="<?php echo $val['name']; ?>" default="<?php echo isset($val['defaultValue']) ? $val['defaultValue'] : 0; ?>" <?php echo isset($val['class']) ? "class=\"{$val['class']}\"" : ""; echo isset($val['style']) ? "style=\"{$val['style']}\"" : ""; ?> class="combox">
                        <option value="0">默认</option>
                        <?php foreach ($val['options'] as $name=>$value): ?>
                        <option value="<?php echo $value; ?>"><?php echo $name; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php endif; ?>
                </td>
                <?php $index++; endforeach; ?>
                </tr>
            </table>
            <div class="subBar">
                <ul>
                    <li><div class="buttonActive"><div class="buttonContent"><button type="submit">搜索</button></div></div></li>
                </ul>
            </div>
        </div>
    </form>
</div>