 <?php

    use Illuminate\Database\Eloquent\Model;

    class Inventory extends Model
    {
        protected $guarded = [];

        protected $with = ['inventory'];

        public function inventory()
        {
            return $this->belongsTo(inventory::class);
        }
    }
