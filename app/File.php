<?php 
namespace Sugar;

use Illuminate\Database\Eloquent\Model;

class File extends AppModel {
    
    const UPLOAD_BATCH_FILE_DIR = '/files/batch_file/';
     public static function uploadBatchFilePath(){
		return public_path() . self::UPLOAD_BATCH_FILE_DIR;
	}
    protected $table = 'files';
    protected $fillable = ['name','user_id','download_counter','status','shared_with'];

    public function user()
    {
        return $this->belongsTo('\Sugar\User');
    }

    // protected static $sources = [
    //     'FLIP',
    //     'CNF',
    //     'AUZNZ',
    //     'USER',
    //     'OTHER'
    // ];

    // public static function listStatuses(){
    //     return self::$sources;
    // }

}
