<?php 
use yii\helpers\Html;
use yii\helpers\Url;
use miloschuman\highcharts\Highcharts;
use yii\web\JsExpression;
use \yii\db;

$this->title = Yii::t('app', 'Follow Up Dashboard'); 
$this->params['breadcrumbs'][] = $this->title;
?>
<script>
$(document).ready(function(){
    $('.tab-content').slimScroll({
        height: '300px'
    });
});
$(document).ready(function(){
    $('#coursList').slimScroll({
        height: '250px'
    });
});
</script>
<style>
.tab-content {
   padding:15px;
}
.box .box-body .fc-widget-header {
    background: none;
}
.popover{
    max-width:450px;   
}
</style>

<?php
$this->registerJs(
"$(function() {
	$('.noticeModalLink').click(function() {
		$('#NoticeModal').modal('show')
		.find('#NoticeModalContent')
		.load($(this).attr('data-value'));
	});
});");

$this->registerJs(
"$('body').on('click', function (e) {
    $('[data-toggle=\"popover\"]').each(function () {
        if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
            $(this).popover('hide'); 
        }
    });
});"
)
?>

<?php $empSession = Yii::$app->session->get('emp_id'); ?>

<?php
	yii\bootstrap\Modal::begin([
	    'header' => '<h4><i class="fa fa-eye"></i> '.Yii::t('app', 'View Notice Details').'</h4>',
	    'id'=>'NoticeModal',
	]);
	echo '<div id="NoticeModalContent"></div>';
	yii\bootstrap\Modal::end();
?>

                <!-- Main content -->
                <section class="content">
				
					<div style="font-size:20px;padding-bottom:10px;">&nbsp;&nbsp;<i class="fa fa-inbox">&nbsp;&nbsp;</i><?php echo Yii::t('app', 'Potential Candidates') ?></div>
                    <div class="row">
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3>
									<?php
									if($empSession == null || $empSession == ''){
										echo app\models\StuFollowup::find()->where(['finder' => 0])->count();
									}
									else{
										echo app\models\StuFollowup::find()->where(['emp_id' => $empSession])->count();
									}
									?>
									
                                    </h3>
                                    <p>
                                        <?php echo Yii::t('app', 'Total Follow-ups') ?>
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-ios-people"></i>
                                </div>
								<?= Html::a(Yii::t('app', 'More info').' <i class="fa fa-arrow-circle-right"></i>', ['/student/stu-master/index'], ['target' => '_blank', 'class' => 'small-box-footer']); ?>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h3>
									   <?php
									if($empSession == null || $empSession == ''){
										echo app\models\StuFollowup::find()->where(['pending' => 0])->count();
									}
									else{
										echo app\models\StuFollowup::find()->where(['emp_id' => $empSession])->andWhere(['pending' => 0])->count();
									}
									?>
                                    </h3>
                                    <p>
                                        <?php echo Yii::t('app', 'Pending Follow-ups') ?>
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person"></i>
                                </div>
				<?= Html::a(Yii::t('app', 'More info').' <i class="fa fa-arrow-circle-right"></i>', ['/employee/emp-master/index'], ['target' => '_blank', 'class' => 'small-box-footer']); ?>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3>
                                        <!-- <?= app\modules\course\models\Courses::find()->where(['is_status' => 0])->count(); ?> -->
										<?php $val1=7 ?>
										<?= $val1 ?>
                                    </h3>
                                    <p>
                                        <?php echo Yii::t('app', 'Counseling Sessions') ?>
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-graduation-cap"></i>
                                </div>
				<?= Html::a(Yii::t('app', 'More info').' <i class="fa fa-arrow-circle-right"></i>', ['/course/courses/index'], ['target' => '_blank', 'class' => 'small-box-footer']); ?>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>
                                        <!-- <?= app\modules\course\models\Batches::find()->where(['is_status' => 0])->count(); ?> -->
										<?php $val1=69 ?>
										<?= $val1 ?>
                                    </h3>
                                    <p>
                                        <?php echo Yii::t('app', 'Total Enquiries') ?>
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-sitemap"></i>
                                </div>
                                <?= Html::a(Yii::t('app', 'More info').' <i class="fa fa-arrow-circle-right"></i>', ['/course/batches/index'], ['target' => '_blank', 'class' => 'small-box-footer']); ?>
                            </div>
                        </div><!-- ./col -->
                    </div><!-- /.row -->


                    <!-- Main row -->
                    <div class="row">
                        <!-- Left col -->
                        <section class="col-lg-7 connectedSortable">
							
<!---Start Second Row Recently Added Student List Block---> 
<div class="row">
<div class="col-md-12">
	<div class="box box-info">
		<div class="box-header with-border">
			<h3 class="box-title"><i class="fa fa-list-ul"></i> <?php echo Yii::t('followup', 'Recently Added Follow-ups'); ?></h3>
			<div class="box-tools <?= (Yii::$app->language == 'ar') ? 'pull-left' : 'pull-right'; ?>">
				<button class="btn btn-info btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
				<button class="btn btn-info btn-sm" title="Remove" data-toggle="tooltip" data-widget="remove"><i class="fa fa-times"></i></button>
			</div>
		</div>
		<div class="box-body table-responsive">
			<table class="table no-margin">
				<thead>
					<tr>
						<th><?php echo Yii::t('followup', 'Student Name'); ?></th>
						<th><?php echo Yii::t('followup', 'Status'); ?></th>
						<th><?php echo Yii::t('followup', 'Comments'); ?></th>
						<th><?php echo Yii::t('followup', 'Followup Pending'); ?></th>
						<th><?php echo Yii::t('followup', 'Date and Time'); ?></th>
					</tr>
				</thead>
				<tbody>
				  <?php
					if($empSession == null || $empSession == ''){
						$followupinfo = app\models\StuFollowup::find()->where(['finder' => 0])->limit(3)->all(); 
					}
					else{
						$followupinfo = app\models\StuFollowup::find()->where(['emp_id' => $empSession])->limit(3)->all(); 
					}
				?>
				<?php $ury = app\models\StuFollowup::findBySql('select DISTINCT * from stu_info s, stu_followup f where s.stu_info_id=f.student_id')->all();
				?>
				<?php $stuinfo = app\modules\student\models\StuInfo::findBySql('Select * from stu_info')->all(); ?>
				<?php if($followupinfo) : ?>
				<?php foreach($followupinfo as $v) : ?>
					<tr>
					<?php $info1 = app\modules\student\models\StuInfo::find()->where(['stu_info_id' => $v['student_id']])->limit(1)->one();?>
						<td><?= $info1['stu_first_name']." ".$info1['stu_last_name']; ?></td>
						<td><?= $v['status'];?></td>
						<td><?= $v['comments'];?></td>
						<?php
						if($v['pending']):
							$name = "No";
						else:
							$name = "Yes";
						endif;
						?>
						<td><?= $name;?></td>
						<td><?= $v['time'];?></td>
					</tr>
				<?php endforeach; ?>
				<?php else : ?>
					<tr>
						<td colspan="6" class="text-danger text-center"><?php echo Yii::t('followup', 'No results found.'); ?></td>
					</tr>
				<?php endif; ?>
				</tbody>
			</table>
		</div>
	</div>	
	<div class="box-footer clearfix">
			<?php if(Yii::$app->user->can("/followup/stu-master/create")) { ?>
			
			    <?php echo Html::a(Yii::t('followup', 'Add Follow-up'), ['stu-followup-master/create'], ['class'=>'btn btn-sm btn-info btn-flat pull-left']); ?>
			<?php } ?>
			<?php echo Html::a(Yii::t('followup', 'View All Students'), ['stu-followup-master/index'], ['class'=>'btn btn-sm btn-default btn-flat pull-right']); ?>
		</div>

</div>
</div>
<!---End Recently Student Added Block--->


                        </section><!-- /.Left col -->

                        <!-- right col (We are only adding the ID to make the widgets sortable)-->
                        <section class="col-lg-5 connectedSortable">
						
						
						<div class="nav-tabs-custom"><!-- .nav-tabs-custom -->
                                <!-- Tabs within a box -->
                                <ul class="nav nav-tabs pull-right">
                                    <li><a href="#emp-notice" data-toggle="tab"><?php echo Yii::t('app', 'Counseling') ?></a></li>
				    <li class="active"><a href="#all-notice" data-toggle="tab"><?php echo Yii::t('app', 'Follow Ups') ?></a></li>
                                    <li class="pull-left header" style="<?= (Yii::$app->language == 'ar') ? 'left:35%' : ''; ?>"><i class="fa fa-inbox"></i><?php echo Yii::t('app', 'Notice Board') ?></li>
                                </ul>
                                <div class="tab-content">
                                    <!-- Notice -->
                                    <div class="tab-pane active" id="all-notice">
					
					<?php $noticeList = app\modules\dashboard\models\Notice::find()->where("is_status = 0 AND notice_user_type = '0'")->all();

				    if(!empty($noticeList)) {
					foreach($noticeList as $nl) :
					?>
					<div class="notice-main bg-light-blue">
						<div class="notice-disp-date">
						<small class="label label-success"><i class="fa fa-calendar"></i> <?= (!empty($nl->notice_date) ? Yii::$app->formatter->asDate($nl->notice_date) : "Not Set"); ?></small>	
						</div>
						<div class="notice-body">
							 <div class="notice-title"><?= Html::a($nl->notice_title, '#', ['style' => 'color:#FFF', 'class'=>'noticeModalLink', 'data-value'=>Url::to(['dashboard/notice/view-popup','id'=>$nl->notice_id])]); ?>&nbsp; </div>
							 <div class="notice-desc"><?= $nl->notice_description; ?> </div>
						</div>					          
					</div>
					<?php endforeach; 
				     } else {
						echo '<div class="box-header bg-warning"><div style="padding:5px">';
						echo Yii::t('app', 'No Notice....');
						echo '</div></div>';
				     }
					?>
				    </div>
                                    <div class="tab-pane" id="stu-notice">
					
					<?php $noticeList = app\modules\dashboard\models\Notice::find()->where("is_status = 0 AND notice_user_type = 'S'")->all();

				    if(!empty($noticeList)) {
					foreach($noticeList as $nl) :
					?>
					 <div class="notice-main bg-aqua">
						<div class="notice-disp-date">				        		<small class="label label-success"><i class="fa fa-calendar"></i> <?= (!empty($nl->notice_date) ? Yii::$app->formatter->asDate($nl->notice_date) : "Not Set"); ?></small>	
						</div>
						<div class="notice-body">
							 <div class="notice-title"><?= Html::a($nl->notice_title, '#', ['style' => 'color:#FFF', 'class'=>'noticeModalLink', 'data-value'=>Url::to(['dashboard/notice/view-popup','id'=>$nl->notice_id])]); ?>&nbsp; </div>
							 <div class="notice-desc"><?= $nl->notice_description; ?> </div>
						</div>					          
					</div>
					<?php endforeach;
				      } else {
						echo '<div class="box-header bg-warning"><div style="padding:5px">';
						echo Yii::t('app', 'No Notice....');
						echo '</div></div>';
				      }
					?>
				    </div>
				    <div class="tab-pane" id="emp-notice">
					
					<?php $noticeList = app\modules\dashboard\models\Notice::find()->where("is_status = 0 AND notice_user_type = 'E'")->all();

				    if(!empty($noticeList)) {
					foreach($noticeList as $nl) :
					?>
					 <div class="notice-main bg-teal">
						<div class="notice-disp-date">	<small class="label label-success"><i class="fa fa-calendar"></i> <?= (!empty($nl->notice_date) ? Yii::$app->formatter->asDate($nl->notice_date) : "Not Set"); ?></small>	
						</div>
						<div class="notice-body">
							 <div class="notice-title"><?= Html::a($nl->notice_title, '#', ['style' => 'color:#FFF', 'class'=>'noticeModalLink', 'data-value'=>Url::to(['dashboard/notice/view-popup','id'=>$nl->notice_id])]); ?>&nbsp; </div>
							 <div class="notice-desc"><?= $nl->notice_description; ?> </div>
						</div>					          
					</div>
					<?php endforeach;
				      } else {
						echo '<div class="box-header bg-warning"><div style="padding:5px">';
						echo Yii::t('app', 'No Notice....');
						echo '</div></div>';
				      }
					?>
				    </div>
                                </div> <!--  /.tab-content -->
                            </div><!-- /.nav-tabs-custom -->
						
						

			    <div class="nav-tabs-custom"><!-- .nav-tabs-custom -->
                                <!-- Tabs within a box -->
                                <ul class="nav nav-tabs pull-right">
								
			    <!-- TO DO List -->
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title <?= (Yii::$app->language == 'ar') ? 'pull-right' : ''; ?>"><i class="ion ion-university"></i> <?php echo Yii::t('app', 'Courses') ?></h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <ul class="todo-list" id="coursList">
				     <?php 
					$courseList = app\modules\course\models\Courses::find()->where(['is_status' => 0])->all(); 
					foreach($courseList as $cl) :
				     ?>
                                        <li>
                                            <span class="handle">
                                                <i class="fa fa-ellipsis-v"></i>
                                                <i class="fa fa-ellipsis-v"></i>
                                            </span>
                                            <span class="text"><?php echo $cl->course_name;?></span>
                                            <?php $stuCount = app\modules\student\models\stuMaster::find()->where(['stu_master_course_id' => $cl->course_id, 'is_status' => 0])->count();?>
					    <span class="notification-container <?= (Yii::$app->language == 'ar') ? 'pull-left' : 'pull-right'; ?> text-teal" title="<?= $stuCount; ?> Students"><i class="fa fa-users"></i><span class="label label-info notification-counter"><?= $stuCount; ?></span></span>
                                        </li>
				     <?php endforeach; ?>
                                    </ul>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->

                        </section><!-- right col -->
                    </div><!-- /.row (main row) -->

                </section><!-- /.content -->

