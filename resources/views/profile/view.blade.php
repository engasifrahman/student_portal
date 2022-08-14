<div class="col-md-12 p-3">
    <?php
    if (isset($user)) 
    {
        ?>
      <div class="col-md-4 mx-auto text-center">
          <img src="{{ asset($user->pic_dir) }}" class="bg-secondary rounded-circle" alt="{{ $user->name }}" height="120" width="120">
      </div>
      <div class="col-md-12">
        <div class="col-xs-6 col-sm-6 col-md-6 pull-left text-right pr-0"><strong class="text-info">Name&nbsp;&nbsp;&nbsp;&nbsp;:</strong></div>
        <div class="col-xs-6 col-sm-6 col-md-6 pull-right text-justify pl-0">&nbsp;&nbsp;&nbsp;&nbsp;{{ $user->name }}</div>
        <div class="clearfix"></div>

        <div class="col-xs-6 col-sm-6 col-md-6 pull-left text-right pr-0"><strong class="text-info">ID&nbsp;&nbsp;&nbsp;&nbsp;:</strong></div>
        <div class="col-xs-6 col-sm-6 col-md-6 pull-right text-justify pl-0">&nbsp;&nbsp;&nbsp;&nbsp;{{ $user->user_id }}</div>
        <div class="clearfix"></div>

        <div class="col-xs-6 col-sm-6 col-md-6 pull-left text-right pr-0"><strong class="text-info">Type&nbsp;&nbsp;&nbsp;&nbsp;:</strong></div>
        <div class="col-xs-6 col-sm-6 col-md-6 pull-right text-justify pl-0">&nbsp;&nbsp;&nbsp;&nbsp;{{ $user->type }}</div>
        <div class="clearfix"></div>

        <?php
        if ($user->type === 'Faculty Member') 
        {
          ?>
          <div class="col-xs-6 col-sm-6 col-md-6 pull-left text-right pr-0"><strong class="text-info">Abbreviation&nbsp;&nbsp;&nbsp;&nbsp;:</strong></div>
          <div class="col-xs-6 col-sm-6 col-md-6 pull-right text-justify pl-0">&nbsp;&nbsp;&nbsp;&nbsp;{{ $user->abbreviation }}</div>
          <div class="clearfix"></div>
          <?php
        }
        ?>
        
        <?php
        if ($user->type !== 'Student') 
        {
          ?>
          <div class="col-xs-6 col-sm-6 col-md-6 pull-left text-right pr-0"><strong class="text-info">Designation&nbsp;&nbsp;&nbsp;&nbsp;:</strong></div>
          <div class="col-xs-6 col-sm-6 col-md-6 pull-right text-justify pl-0">&nbsp;&nbsp;&nbsp;&nbsp;{{ $user->designation }}</div>
          <div class="clearfix"></div>
          <?php
        }
        ?>

        <div class="col-xs-6 col-sm-6 col-md-6 pull-left text-right pr-0"><strong class="text-info">Faculty&nbsp;&nbsp;&nbsp;&nbsp;:</strong></div>
        <div class="col-xs-6 col-sm-6 col-md-6 pull-right text-justify pl-0">&nbsp;&nbsp;&nbsp;&nbsp;{{ $user->faculty }}</div>
        <div class="clearfix"></div>

        <div class="col-xs-6 col-sm-6 col-md-6 pull-left text-right pr-0"><strong class="text-info">Department&nbsp;&nbsp;&nbsp;&nbsp;:</strong></div>
        <div class="col-xs-6 col-sm-6 col-md-6 pull-right text-justify pl-0">&nbsp;&nbsp;&nbsp;&nbsp;{{ $user->department }}</div>
        <div class="clearfix"></div>

        <div class="col-xs-6 col-sm-6 col-md-6 pull-left text-right pr-0"><strong class="text-info">Enrollment&nbsp;&nbsp;&nbsp;&nbsp;:</strong></div>
        <div class="col-xs-6 col-sm-6 col-md-6 pull-right text-justify pl-0">&nbsp;&nbsp;&nbsp;&nbsp;{{ $user->semester }}</div>
        <div class="clearfix"></div>

        <div class="col-xs-6 col-sm-6 col-md-6 pull-left text-right pr-0"><strong class="text-info">Gender&nbsp;&nbsp;&nbsp;&nbsp;:</strong></div>
        <div class="col-xs-6 col-sm-6 col-md-6 pull-right text-justify pl-0">&nbsp;&nbsp;&nbsp;&nbsp;{{ $user->gender }}</div>
        <div class="clearfix"></div>

        <div class="col-xs-6 col-sm-6 col-md-6 pull-left text-right pr-0"><strong class="text-info">Marital Status&nbsp;&nbsp;&nbsp;&nbsp;:</strong></div>
        <div class="col-xs-6 col-sm-6 col-md-6 pull-right text-justify pl-0">&nbsp;&nbsp;&nbsp;&nbsp;{{ $user->marital_status }}</div>
        <div class="clearfix"></div>

        <div class="col-xs-6 col-sm-6 col-md-6 pull-left text-right pr-0"><strong class="text-info">Date of Bitrh&nbsp;&nbsp;&nbsp;&nbsp;:</strong></div>
        <div class="col-xs-6 col-sm-6 col-md-6 pull-right text-justify pl-0">&nbsp;&nbsp;&nbsp;&nbsp;{{ $user->dob }}</div>
        <div class="clearfix"></div>

        <div class="col-xs-6 col-sm-6 col-md-6 pull-left text-right pr-0"><strong class="text-info">Nationality&nbsp;&nbsp;&nbsp;&nbsp;:</strong></div>
        <div class="col-xs-6 col-sm-6 col-md-6 pull-right text-justify pl-0">&nbsp;&nbsp;&nbsp;&nbsp;{{ $user->nationality }}</div>
        <div class="clearfix"></div>
        
        <?php
        if (!empty($user->nid)) 
        {
          ?>
          <div class="col-xs-6 col-sm-6 col-md-6 pull-left text-right pr-0"><strong class="text-info">National ID&nbsp;&nbsp;&nbsp;&nbsp;:</strong></div>
          <div class="col-xs-6 col-sm-6 col-md-6 pull-right text-justify pl-0">&nbsp;&nbsp;&nbsp;&nbsp;{{ $user->nid }}</div>
          <div class="clearfix"></div>
          <?php
        }
        ?>

        <?php
        if (!empty($user->birth_certificate)) 
        {
          ?>
          <div class="col-xs-6 col-sm-6 col-md-6 pull-left text-right pr-0"><strong class="text-info">Birth Certificate&nbsp;&nbsp;&nbsp;&nbsp;:</strong></div>
          <div class="col-xs-6 col-sm-6 col-md-6 pull-right text-justify pl-0">&nbsp;&nbsp;&nbsp;&nbsp;{{ $user->birth_certificate }}</div>
          <div class="clearfix"></div>
          <?php
        }
        ?>

        <div class="col-xs-6 col-sm-6 col-md-6 pull-left text-right pr-0"><strong class="text-info">Father Name&nbsp;&nbsp;&nbsp;&nbsp;:</strong></div>
        <div class="col-xs-6 col-sm-6 col-md-6 pull-right text-justify pl-0">&nbsp;&nbsp;&nbsp;&nbsp;{{ $user->father_name }}</div>
        <div class="clearfix"></div>

        <div class="col-xs-6 col-sm-6 col-md-6 pull-left text-right pr-0"><strong class="text-info">Mother Name&nbsp;&nbsp;&nbsp;&nbsp;:</strong></div>
        <div class="col-xs-6 col-sm-6 col-md-6 pull-right text-justify pl-0">&nbsp;&nbsp;&nbsp;&nbsp;{{ $user->mother_name }}</div>
        <div class="clearfix"></div>

        <div class="col-xs-6 col-sm-6 col-md-6 pull-left text-right pr-0"><strong class="text-info">Email&nbsp;&nbsp;&nbsp;&nbsp;:</strong></div>
        <div class="col-xs-6 col-sm-6 col-md-6 pull-right text-justify pl-0">&nbsp;&nbsp;&nbsp;&nbsp;{{ $user->email }}</div>
        <div class="clearfix"></div>
        
        <?php
        if (!empty($user->altr_email)) 
        {
          ?>
          <div class="col-xs-6 col-sm-6 col-md-6 pull-left text-right pr-0"><strong class="text-info">Alternative Email&nbsp;&nbsp;&nbsp;&nbsp;:</strong></div>
          <div class="col-xs-6 col-sm-6 col-md-6 pull-right text-justify pl-0">&nbsp;&nbsp;&nbsp;&nbsp;{{ $user->altr_email }}</div>
          <div class="clearfix"></div>
          <?php
        }
        ?>

        <div class="col-xs-6 col-sm-6 col-md-6 pull-left text-right pr-0"><strong class="text-info">Phone&nbsp;&nbsp;&nbsp;&nbsp;:</strong></div>
        <div class="col-xs-6 col-sm-6 col-md-6 pull-right text-justify pl-0">&nbsp;&nbsp;&nbsp;&nbsp;{{ $user->phone }}</div>
        <div class="clearfix"></div>
        
        <?php
        if (!empty($user->altr_phone)) 
        {
          ?>
          <div class="col-xs-6 col-sm-6 col-md-6 pull-left text-right pr-0"><strong class="text-info">Alternative Phone&nbsp;&nbsp;&nbsp;&nbsp;:</strong></div>
          <div class="col-xs-6 col-sm-6 col-md-6 pull-right text-justify pl-0">&nbsp;&nbsp;&nbsp;&nbsp;{{ $user->altr_phone }}</div>
          <div class="clearfix"></div>
          <?php
        }
        ?>

        <div class="col-xs-6 col-sm-6 col-md-6 pull-left text-right pr-0"><strong class="text-info">Present Address&nbsp;&nbsp;&nbsp;&nbsp;:</strong></div>
        <div class="col-xs-6 col-sm-6 col-md-6 pull-right text-justify pl-0">&nbsp;&nbsp;&nbsp;&nbsp;{{ $user->present_addr }}</div>
        <div class="clearfix"></div>

        <div class="col-xs-6 col-sm-6 col-md-6 pull-left text-right pr-0"><strong class="text-info">Permanent Address&nbsp;&nbsp;&nbsp;&nbsp;:</strong></div>
        <div class="col-xs-6 col-sm-6 col-md-6 pull-right text-justify pl-0">&nbsp;&nbsp;&nbsp;&nbsp;{{ $user->permanent_addr }}</div>
        <div class="clearfix"></div>
      </div>
      <?php
    }
    ?>
</div>