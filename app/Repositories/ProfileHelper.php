<?php 

namespace App\Repositories;

use App\Models\User;

class ProfileHelper
{
    protected $profile, $total_fields, $required_fields, $optional_fields;

    public function __construct(User $profile)
    {
        $this->profile = $profile;
        $this->total_fields = 15;
        $this->required_fields = 10;
        $this->optional_fields = [
            ['name' => 'image', 'size' => 1],
            ['name' => 'bio', 'size' => 1],
            ['name' => 'links', 'size' => 2],
            ['name' => 'postal_code', 'size' => 1],
        ];
    }

    public function calculate_store_percentage()
    {
        $this->profile->data_percent = $this->calculate_percentage();
        $this->profile->save();
    }
    
    protected function calculate_percentage()
    {
        $data = $this->profile->fresh()->load('links')->toArray();
        $counter = 0;
        foreach ($this->optional_fields as $field) {
            $field_size = $field['size'];
            $field_data = $data[$field['name']];
            if($field_size == 1 && $field_data != null){
                $counter ++;
            }
            if($field_size > 1){
                if(count($field_data) < $field_size){
                    $counter = $counter + count($field_data);
                }else{
                    $counter = $counter + $field_size;
                }
            }
        }
        $percentage = (($this->required_fields + $counter) / $this->total_fields) * 100;
        return $percentage;
    }

    
}