<?php  
	class Templates extends Illuminate\Database\Eloquent\Model {
	    protected $table = 'templates';

	    protected $fillable = [ 'id', 'template_name', 'template_url', 'unit', 'label_width', 'label_height', 'vertical_margin', 'horizontal_margin', 'USER_ID'];

	    public $timestamps = false;

	    protected $primaryKey = 'id';
	}
?>