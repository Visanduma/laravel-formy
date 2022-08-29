# 🚫 UNDER DEVELOPMENT

# Laravel-formy

## Class based simple Form builder for any laravel Application

## Installation

You can install the package via composer

```bash
composer require visanduma/laravel-formy
```

You can publish and run the migrations. migrations are required for formy-media management

```bash
php artisan vendor:publish --tag="formy-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="formy-config"
```

Also you need to publish formy assets folder to your public assets

```bash
php artisan vendor:publish --tag="formy-assets"
```

This is the contents of the published config file:

```php
return [

	 /*
    |--------------------------------------------------------------------------
    | Apply any middlware to formy realated routes
    |--------------------------------------------------------------------------
    |
    */
    
    'middlewares' => [
        'web'
    ],
    
    
    /*
    |--------------------------------------------------------------------------
    | Formy media managemt setup
    |--------------------------------------------------------------------------
    |
    */

    'media' => [

        // Disk to store file uploded by formy
        'disk' => 'public',

        // File upload path
        'upload_path' => 'formy-media',

        // Tempory file path
        'temp_path' => 'formy/temp-uploads',

        // Media handler class
        'handler' => \Visanduma\LaravelFormy\Handlers\FormyMediaHandler::class

    ]

];
```


## Usage

### Create form
To create new form use command

```php
php artisan make:form UserForm
php artisan make:form Admin/UserForm
```

All form classes will be saved to ```app/Forms```


Following example is represent UserForm class. by default all methods are empty & need to manually handle the logic your self.

```php
<?php


namespace App\Forms;

use Visanduma\LaravelFormy\Contracts\FormContract;
use Visanduma\LaravelFormy\Form;
use App\Models\User;

class UserForm extends Form implements FormContract
{

	protected $model = User::class;

	public function inputs(): array
    {
        return [
            // form inputs
        ];
    }


	public function store(Request $request)
    {
		// handle form store method
	}

	public function update(Request $request)
    {
		// handle form store method
	}


}
```

### Inputs

Currently laravel-formy has few inputs as bellow

- CheckBoxes
- ColorInput
- DateInput
- FileInput
- FilePond (File uploader input)
- NumberInput
- PasswordInput
- QuillEditor
- RadioInputs
- RangeInput
- Select
- TextArea
- TextInput

You can create new Input instance using ```make()``` static method.
the first parameter will be used to make input Label. second parameter is used as input Name (and table column name). if second parameter is not set the lower snakecase value of the first parameter will be use as the input name.

```php
TextInput::make('Title') // input name is title
TextInput::make('Mothers Name') // input name is mothers_name
TextInput::make('School Name','school') // input name is school
```


Let's add some inputs to UserForm

```php
use Visanduma\LaravelFormy\Inputs\TextInput;
...

public function inputs(): array
    {
        return [
            TextInput::make('Name')->rules('required'),
            TextInput::make('User Name', 'username'),
            TextInput::make('Email')->rules('required'),
        ];
    }

```

This input may create simple HTML form with three inputs for Name,User Name & Email

To show generated form you need to render it on your View blade. see following example

```php
// in UserController.php
// make form 'Create' instance and send it to view

public function createUser(){

	$form = UserForm::createForm();

	return view('users.create',compact('form'));

}


// make User update form
public function editUser(User $user){

	$form = UserForm::updateForm($user); // set model for update

	return view('users.edit',compact('form'));

}


// in users.create.blade.php & users.edit.blade.php 
// use @formy directive to render form HTML


<div>
	@formy($form)
</div>

// or

<div>
	{!! $form->render() !!}
</div>

```


### Handling form submit

We use ```store``` method for this. by default store method may received Request object and all the form data will be included. now you can manipulate form as your needs. see simple example bellow

```php

// UserForm.class

 public function store(Request $request)
 {
	$this->validate(); // validating the inputs
	
	$this->createEntity(); // create new model with request data & save

	return back()->with('message','New user created');

 }

```


### Handling form update

Use ```update``` method for handling the form updates. when user click Update button on form 'update' method will be called with request data. see simple example bellow

```php
// UserForm.php

public function update(Request $request)
    {
        $this->validate();
        $this->updateEntity();

        return back()->with('message', 'Successfully Updated');
    }


// Another approach
public function update(Request $request)
    {
        $this->validate();
        $user = $this->getModel();
		$user->update($request->only('name'));

        return back()->with('message', 'Successfully Updated');
    }


``` 



### Common input methods
```php

// validation helpers
->rules('required|min:7')
->rules(['required' , 'min:7'])

// attributes helpers
->setAttribute('placeholder','Enter name') // set attribute values to HTML input
->getAttribute('placeholder') // 'Enter name'
->placeholder('Enter name')
->addLabelClass('text-info')
->setId('nameInput')
->setId('nameInput')
->setValue('Nova Lee')
->maxLength(5)

// layout helpers
->width(4) // set input column width 1 - 12
->singleLine() // make only one input for row
->inline() // make input inline with it's label

// visibility helpers
->hideIf(function(){
	return true; // return boolian
})

->hideOnUpdate() // hide input on Update form
->hideOnCreate() // hide input on Create form
->showOnUpdate() // default : show input on Update form
->showOnCreate() // default : show input on Create form




```

### Form helpers

```php
// send additional data with form
$form->withData([
	'userType' => 'Super User'
])

// get additional data
$form->getData('userType') // 'Super User'

// check the form status is update or create
$form->isUpdateForm() // return boolean
$form->isCreateForm() // return boolean


```




## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/Visanduma/.github/blob/main/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

-   [LaHiRu](https://github.com/Visanduma)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
