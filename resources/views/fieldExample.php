//https://gist.github.com/pestopancake/746ccb4d98f20cc51b6794b576ed6292#file-relationfields-blade-php
/**
* If 'fields' is not provided then the fields from the crudpanel will be used
*/

        $this->addField([
            'label' => "Beneficiaries",
            'type' => 'relationFields',
            'name' => 'beneficiaries',
            'foreignKey' => 'member_id',
            'crud' => crudPanel(MemberBeneficiaryCrudPanel::class),
            'fake' => true,
            'additional_fields_count' => 6,
            'fields' => [
                [
                    'label' => "First Names",
                    'type' => 'text',
                    'name' => 'name',
                    'attribute' => 'name',
                ],
                [
                    'label' => "Last Name",
                    'type' => 'text',
                    'name' => 'last_name',
                    'attribute' => 'last_name',
                ],
                [
                    'label' => "Relationship",
                    'type' => 'text',
                    'name' => 'relationship',
                    'attribute' => 'relationship',
                ],
                [
                    'label' => "Percentage",
                    'type' => 'number',
                    'name' => 'percentage',
                    'attribute' => 'percentage',
                    'suffix' => '%'
                ],
                [
                    'label' => "Note",
                    'type' => 'textarea',
                    'name' => 'note',
                    'attribute' => 'note',
                ]
            ],
            'tab' => 'Beneficiaries',
        ], 'both');