<?php

    if (isset($createBtn)) 
    {
        if ($createBtn === 'Yes') 
        {
            $showCreateBtn = true;
        }
        elseif ($createBtn === 'No') 
        {
            $showCreateBtn = false;
        }
        else
        {
            $showCreateBtn = true;
        }
    }
    else
    {
        $showCreateBtn = true;
    }

    if (isset($editBtn)) 
    {
        if ($editBtn === 'Yes') 
        {
            $showEditBtn = true;
        }
        elseif ($editBtn === 'No') 
        {
            $showEditBtn = false;
        }
        else
        {
            $showEditBtn = false;
        }
    }
    else
    {
        $showEditBtn = false;
    }

?>
<div class="content-wrapper" id="crud_content_wrapper">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div id="{{ strtolower($Name) }}_notification_content" class="text-center no-display"></div>
			<br>
			<div class="card">
				<div class="card-header bg-info">
					<span class="h6 text-white" id="{{ strtolower($Name) }}_title">{{ $Title }}</span>
					<span class="h6 text-white no-display" id="{{ strtolower($Name) }}_create_title">
						<i class="fa fa-plus-square-o fa-lg"></i> {{ $Title }}
					</span>
                    <span class="h6 text-white no-display" id="{{ strtolower($Name) }}_edit_title">
                        <i class="fa fa-pencil-square-o fa-lg"></i> {{ $Title }}
                    </span>

                    <?php
                    if ($showCreateBtn) 
                    {
                        ?>
                        <a class="pointer pull-right text-white" id="{{ strtolower($Name) }}_create_btn" title="Add New" onclick="Create{{ $Name }}()"> 
                            <i class="fa fa-plus-square-o fa-lg"></i>
                        </a>
                        <?php
                    }
                    ?>

                    <?php
                    if ($showEditBtn) 
                    {
                        ?>
                        <a class="pointer pull-right text-white" id="{{ strtolower($Name) }}_edit_btn" title="Edit" onclick="Edit{{ $Name }}('{{ $editId }}');"> 
                        <i class="fa fa-pencil-square-o"></i>
                        </a>
                        <?php
                    }
                    ?>

					<a class="pointer pull-right text-white no-display" id="{{ strtolower($Name) }}_cancel_btn" title="Cancel">
						<i class="icon-cross2"></i>
					</a>
				</div>
				<div class="card-body">
					<div class="col-md-12 col-sm-12 col-xs-12 no-display" id="{{ strtolower($Name) }}_createEdit_content">
                        <div class="col-md-12 mt-1 mb-3">
                            <div class="col-md-12">
                                <div class="forms-sample">
                                    <p class="pb-1 text-info text-center">
                                        Please fill out the <strong class="text-danger">*required</strong> fields
                                    </p>

                                    <form id="{{ strtolower($Name) }}_form" method="post" enctype="multipart/form-data">

                                        <input type="hidden" id="{{ strtolower($Name) }}_action" name="{{ strtolower($Name) }}_action" value="null">

                                        <input type="hidden" id="{{ strtolower($Name) }}_id" name="{{ strtolower($Name) }}_id" value="null">
                                        
                                        <input type="hidden" id="{{ strtolower($Name) }}_pic_dir" name="{{ strtolower($Name) }}_pic_dir">

                                        <?php echo $Form; ?>

                                        <div class="col-md-12 pull-left mx-auto text-center pb-3">
                                            <button type="reset" class="btn btn-outline-warning mr-1 pointer" id="{{ strtolower($Name) }}_reset_btn" name="{{ strtolower($Name) }}_reset">
                                                <i class="icon-cross2"></i> Reset
                                            </button>

                                            <button type="submit" class="btn btn-outline-primary pointer" id="{{ strtolower($Name) }}_update_btn" name="{{ strtolower($Name) }}_update" onclick="{{ $Name }}ClearValidation();">
                                                <i class="icon-check2"></i> Update
                                            </button>

                                            <button type="submit" class="btn btn-outline-primary pointer" id="{{ strtolower($Name) }}_store_btn" name="{{ strtolower($Name) }}_store" onclick="{{ $Name }}ClearValidation();">
                                                <i class="icon-check2"></i> Save
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>               
                    </div>
					<div class="col-md-12 col-sm-12 col-xs-12" id="{{ strtolower($Name) }}_view_content"></div>

                    <!-- Delete Modal -->
                    <div class="modal fade" id="{{ strtolower($Name) }}_delete_modal" tabindex="-1" role="dialog" aria-labelledby="{{ strtolower($Name) }}_delete_modal" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title text-center" id="myModalLabel18"><i class="fa fa-trash-o fa-lg text-danger"></i> Delete Confirmation</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="{{ $Name }}ClearForm();">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="alert alert-warning text-center" role="alert">
                                        <strong>Are you sure!</strong>&nbsp;To confirm delete please press on "Confirm" button
                                    </div>
                                </div>
                                <div class="text-center modal-footer">
                                    <button type="button" class="btn btn-outline-warning" data-dismiss="modal" onclick="{{ $Name }}ClearForm();">
                                        Cancel
                                    </button>

                                    <button type="button" class="btn btn-outline-primary" onclick="Delete{{ $Name }}()" data-dismiss="modal">
                                        Confirm
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Delete Modal -->
				</div>
			</div>
		</div>
	</div>
</div>