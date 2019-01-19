<?php

GFForms::include_feed_addon_framework();

class GFAcculynxAddOn extends GFFeedAddOn {

    protected $_version = '1.0.0';
    protected $_min_gravityforms_version = '2.0.0';
    protected $_slug = 'acculynxaddon';
    protected $_path = 'acculynxaddon/acculynxaddon.php';
    protected $_full_path = __FILE__;
    protected $_title = 'Gravity Forms Acculynx Add-On';
    protected $_short_title = 'Acculynx';
    private static $_instance = null;
    public $api_key;

    /**
     * Get an instance of this class.
     *
     * @return GFacculynxaddon
     */
    public static function get_instance() {

        if (self::$_instance == null) {

            self::$_instance = new GFAcculynxAddOn();
        }

        return self::$_instance;
    }

    public function init() {

        parent::init();

    }

    /**
     * Configures the settings which should be rendered on the add-on settings tab.
     *
     * @return array
     */
    public function plugin_settings_fields() {

        return array(
            array(
                'title' => esc_html__('Acculynx AddOn Settings', 'acculynxaddon'),
                'fields' => array(
                    array(
                        'name' => 'apikey',
                        'label' => esc_html__('Acculynx API Key', 'acculynxaddon'),
                        'type' => 'text',
                        'class' => 'medium',
                    ),
                    array(
                        'name' => 'deleteEntries',
                        'label' => esc_html__('Delete entries after successful submission to Acculynx?', 'acculynxaddon'),
                        'type' => 'radio',
                        'horizontal' => true,
                        'default_value' => 1,
                        'choices' => array(
                            array(
                                'label' => 'Yes',
                                'name' => 'deleteEntries_yes',
                                'value' => 1,
                            ),
                            array(
                                'label' => 'No',
                                'name' => 'deleteEntries_no',
                                'value' => 0,
                            ),
                        ),
                    ),
                ),
            ),
        );
    }

    /**
     * Configures the settings which should be rendered on the feed edit page in the Form Settings > Simple Feed Add-On area.
     *
     * @return array
     */
    public function feed_settings_fields() {

        return array(
            array(
                'title' => esc_html__('Acculynx Feed Settings', 'acculynxaddon'),
                'fields' => array(
                    array(
                        'label' => esc_html__('Feed name', 'acculynxaddon'),
                        'name' => 'feedName',
                        'class' => 'small',
                        'type' => 'text',
                    ),
                    array(
                        'name' => 'mappedFields',
                        'label' => esc_html__('Map Fields', 'acculynxaddon'),
                        'type' => 'field_map',
                        'field_map' => array(
                            array(
                                'name' => 'date',
                                'label' => esc_html__('Date', 'acculynxaddon'),
                                'required' => 0,
                                'field_type' => 'date',
                            ),
                            array(
                                'name' => 'time',
                                'label' => esc_html__('Time', 'acculynxaddon'),
                                'required' => 0,
                                'field_type' => array('radio', 'dropdown'),
                            ),
                            array(
                                'name' => 'company',
                                'label' => esc_html__('Company Name', 'acculynxaddon'),
                                'required' => 0,
                            ),
                            array(
                                'name' => 'email',
                                'label' => esc_html__('Email', 'acculynxaddon'),
                                'required' => 0,
                                'field_type' => 'email',
                            ),
                            array(
                                'name' => 'fname',
                                'label' => esc_html__('First Name', 'acculynxaddon'),
                                'required' => 0,
                            ),
                            array(
                                'name' => 'lname',
                                'label' => esc_html__('Last Name', 'acculynxaddon'),
                                'required' => 0,
                            ),
                            array(
                                'name' => 'phoneNumber1',
                                'label' => esc_html__('Phone Number 1', 'acculynxaddon'),
                                'required' => 0,
                                'field_type' => 'phone',
                            ),
                            array(
                                'name' => 'phoneExtension1',
                                'label' => esc_html__('Phone Ext 1', 'acculynxaddon'),
                                'required' => 0,
                            ),
                            array(
                                'name' => 'phoneNumber2',
                                'label' => esc_html__('Phone Number 2', 'acculynxaddon'),
                                'required' => 0,
                                'field_type' => 'phone',
                            ),
                            array(
                                'name' => 'phoneExtension2',
                                'label' => esc_html__('Phone Ext 2', 'acculynxaddon'),
                                'required' => 0,
                            ),
                            array(
                                'name' => 'phoneNumber3',
                                'label' => esc_html__('Phone Number 3', 'acculynxaddon'),
                                'required' => 0,
                                'field_type' => 'phone',
                            ),
                            array(
                                'name' => 'phoneExtension3',
                                'label' => esc_html__('Phone Ext 3', 'acculynxaddon'),
                                'required' => 0,
                            ),
                            array(
                                'name' => 'address1',
                                'label' => esc_html__('Address Line 1', 'acculynxaddon'),
                                'required' => 0,
                            ),
                            array(
                                'name' => 'address2',
                                'label' => esc_html__('Address Line 2', 'acculynxaddon'),
                                'required' => 0,
                            ),
                            array(
                                'name' => 'city',
                                'label' => esc_html__('City', 'acculynxaddon'),
                                'required' => 0,
                            ),
                            array(
                                'name' => 'state',
                                'label' => esc_html__('State', 'acculynxaddon'),
                                'required' => 0,
                            ),
                            array(
                                'name' => 'zip',
                                'label' => esc_html__('Zipcode', 'acculynxaddon'),
                                'required' => 0,
                            ),
                            array(
                                'name' => 'jobCategory',
                                'label' => esc_html__('Job Category', 'acculynxaddon'),
                                'type' => 'select',
                            ),
                            array(
                                'name' => 'workType',
                                'label' => esc_html__('Job Type', 'acculynxaddon'),
                                'type' => 'select',
                            ),
                            array(
                                'name' => 'summary',
                                'label' => esc_html__('Summary', 'acculynxaddon'),
                                'required' => 0,
                            ),
                        ),
                    ),
                ),
            ),
        );
    }

    /**
     * Configures which columns should be displayed on the feed list page.
     *
     * @return array
     */
    public function feed_list_columns() {

        return array(
            'feedName' => esc_html__('Name', 'acculynxaddon'),
        );
    }

    /**
     * Process the feed
     *
     * @param array $feed The feed object to be processed.
     * @param array $entry The entry object currently being processed.
     * @param array $form The form object currently being processed.
     *
     * @return bool|void
     */

    public function process_feed($feed, $entry, $form) {

        $field_map = $this->get_field_map_fields($feed, 'mappedFields');

        $field_values = array();

        foreach ($field_map as $name => $field_id) {

            $field_values[$name] = $this->get_field_value($form, $entry, $field_id);

        }

        $digits = 3;

        $json = array(
            'firstName' => $field_values['fname'],
            'lastName' => $field_values['lname'],
            'companyName' => $field_values['company'],
            'phoneNumber1' => $field_values['phoneNumber1'],
            'phoneExtension1' => $field_values['phoneExtension1'],
            'phoneType1' => $field_values['phoneType1'],
            'phoneNumber2' => $field_values['phoneNumber2'],
            'phoneExtension2' => $field_values['phoneExtension2'],
            'phoneType2' => $field_values['phoneType2'],
            'phoneNumber3' => $field_values['phoneNumber3'],
            'phoneExtension3' => $field_values['phoneExtension3'],
            'phoneType3' => $field_values['phoneType3'],
            'emailAddress' => $field_values['email'],
            'crossReference' => '',
            'jobCategory' => $field_values['jobCategory'],
            'workType' => $field_values['workType'],
            'street' => $field_values['address1'],
            'street2' => $field_values['address2'],
            'city' => $field_values['city'],
            'state' => $field_values['state'],
            'zip' => $field_values['zip'],
            'country' => 'USA',
            'priority' => 'normal',
            'notes' => $field_values['summary'],
            'salesPerson' => 'dev@leadsnearby.com',
            'initialAppointmentDate' => date('Y-m-d\TH:i:s.000\Z', strtotime($field_values['date'] . ' ' . $field_values['time'] . ' ' . get_option('timezone_string'))),    
        );

        $json = json_encode($json);

        $curl = $this->curl_post($json);

        $settings = $this->get_plugin_settings();

        $delete = $this->get_plugin_setting('deleteEntries');

        if ($curl['code'] == 202 && $delete == 1) {

            GFAPI::delete_entry($entry['id']);

        }

    }

    public function curl_post($request_data = '', $entity = 'leads') {

        $api_key = $this->get_plugin_setting('apikey');
        $url = 'https://api.acculynx.com/api/v1/' . $entity .'?apikey=' .$api_key;

        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $request_data);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($request_data),
        )
        );

        $response = curl_exec($ch);

        $response_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        $curl = array(
            'response' => $response,
            'code' => $response_code,
        );

        return $curl;

    }

}
