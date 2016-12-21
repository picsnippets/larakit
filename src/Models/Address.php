<?php

namespace Buckii\Larakit\Models;

class Address extends Model
{
    protected $table = "addresses";

    protected $fillable = [
        'line_one',
        'line_two',
        'line_three',
        'city',
        'state',
        'zip_code',
    ];

    public static function getStates(): array
    {
        return [
            'AL' => 'Alabama',
            'AK' => 'Alaska',
            'AZ' => 'Arizona',
            'AR' => 'Arkansas',
            'CA' => 'California',
            'CO' => 'Colorado',
            'CT' => 'Connecticut',
            'DE' => 'Delaware',
            'DC' => 'District of Columbia',
            'FL' => 'Florida',
            'GA' => 'Georgia',
            'HI' => 'Hawaii',
            'ID' => 'Idaho',
            'IL' => 'Illinois',
            'IN' => 'Indiana',
            'IA' => 'Iowa',
            'KS' => 'Kansas',
            'KY' => 'Kentucky',
            'LA' => 'Louisiana',
            'ME' => 'Maine',
            'MD' => 'Maryland',
            'MA' => 'Massachusetts',
            'MI' => 'Michigan',
            'MN' => 'Minnesota',
            'MS' => 'Mississippi',
            'MO' => 'Missouri',
            'MT' => 'Montana',
            'NE' => 'Nebraska',
            'NV' => 'Nevada',
            'NH' => 'New Hampshire',
            'NJ' => 'New Jersey',
            'NM' => 'New Mexico',
            'NY' => 'New York',
            'NC' => 'North Carolina',
            'ND' => 'North Dakota',
            'OH' => 'Ohio',
            'OK' => 'Oklahoma',
            'OR' => 'Oregon',
            'PA' => 'Pennsylvania',
            'RI' => 'Rhode Island',
            'SC' => 'South Carolina',
            'SD' => 'South Dakota',
            'TN' => 'Tennessee',
            'TX' => 'Texas',
            'UT' => 'Utah',
            'VT' => 'Vermont',
            'VA' => 'Virginia',
            'WA' => 'Washington',
            'WV' => 'West Virginia',
            'WI' => 'Wisconsin',
            'WY' => 'Wyoming',
        ];
    }

    public static function newEmpty(): Address
    {
        $a = new Address([
            'line_one' => '',
            'line_two' => '',
            'line_three' => '',
            'city' => '',
            'state' => '',
            'zip_code' => '',
        ]);

        $a->save();
        return $a;
    }

    public function getPrintableAddress($name = ''): string
    {
        $name_line = $name;

        $address_lines = $this->line_one;

        if ($this->line_two) {
            $address_lines .= "\n" . $this->line_two;
        }

        if ($this->line_three) {
            $address_lines .= "\n" . $this->line_three;
        }

        return sprintf(
            "%s\n%s\n%s, %s %s",
            $name_line,
            $address_lines,
            $this->city,
            $this->state,
            $this->zip_code
        );
    }
}
