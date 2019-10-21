 <?php

    use Illuminate\Database\Eloquent\Model;

    class Inventory extends Model
    {
        protected $fillable = ['item_id', 'item_quantity', 'item_low', 'item_high', 'item_close_to_expiry'];

        protected $guarded = [];

        protected $with = ['inventory'];

        public function inventory()
        {
            return $this->belongsTo(Inventory::class);
        }
    }
