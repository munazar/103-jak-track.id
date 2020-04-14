        <main class="page-content">
            <div class="container-fluid">
				<h2 id='page_title'><?php echo !empty($title)?$title:''; ?></h2>
                <hr>
                <div class="row">
                    <div class="form-group col-md-12">
						<?php $this->load->view($main_view);?>
					</div>
                </div>
            </div>
        </main>
	  	<!-- page-content" -->