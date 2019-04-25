<?php
use yii\helpers\Html;
?>
<li class="treeview active">
	<?= Html::a('<i class="fa fa-users"></i> <span>'.Yii::t('followup', 'Follow-up').'</span> <i class="fa fa-angle-left pull-right"></i>', ['/student/default/index'])  ?>
        <ul class="treeview-menu">

	<?php if(Yii::$app->user->can('/followup/stufollowupmaster/createfollowup')) : ?>
            <li>
		<?= Html::a('<i class="fa fa-angle-double-right"></i> '.Yii::t('followup', 'Add Follow-up'),['/followup/stufollowupmaster/createfollowup'])  ?>
	    </li>
	<?php endif; ?> 
	
	<?php if(Yii::$app->user->can('/followup/stufollowupmaster/index')) : ?>
	    <li>
		<?= Html::a('<i class="fa fa-angle-double-right"></i> '.Yii::t('stu', 'Manage Follow-ups'),['/followup/stufollowupmaster/index'])  ?>
	    </li>
	<?php endif; ?> 

	<?php if(Yii::$app->user->can('/student/stu-status/index')) : ?>
            <li>
		<?= Html::a('<i class="fa fa-angle-double-right"></i> '.Yii::t('stu', 'Student Status'),['/student/stu-status/index'])  ?>
	    </li>
	<?php endif; ?> 
	
	<?php if(Yii::$app->user->can('/student/stu-import/index')) : ?>
            <li>
		<?= Html::a('<i class="fa fa-angle-double-right"></i> '.Yii::t('stu', 'Import Student'),['/student/stu-import/index'])  ?>
	    </li>
	<?php endif; ?> 

	<?php if(Yii::$app->user->can('/student/stu-category/index')) : ?>
            <li>
		<?= Html::a('<i class="fa fa-angle-double-right"></i> '.Yii::t('stu', 'Admission Category'),['/student/stu-category/index'])  ?>
	    </li>
	<?php endif; ?> 

	<?php if(Yii::$app->user->can('/user/resetstudloginid')) : ?>
	    <li>
		<?= Html::a('<i class="fa fa-angle-double-right"></i> '.Yii::t('app', 'Reset Login'),['/user/resetstudloginid'])  ?>
	    </li>
	<?php endif; ?> 

	<?php if(Yii::$app->user->can('/user/resetstudpassword')) : ?>
            <li>
		<?= Html::a('<i class="fa fa-angle-double-right"></i> '.Yii::t('app', 'Reset Password'),['/user/resetstudpassword'])  ?>
	    </li>
	<?php endif; ?> 
	<?php if(Yii::$app->user->can('/user/resetstudpassword')) : ?>
            <li>
		<?= Html::a('<i class="fa fa-angle-double-right"></i> '.Yii::t('followup', 'All Students'),['/followup/stu-followup-master/index'])  ?>
	    </li>
	<?php endif; ?> 
	
        </ul>
</li>
