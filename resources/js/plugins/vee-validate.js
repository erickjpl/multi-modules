import Vue from 'vue'

import { extend, localize, ValidationObserver, ValidationProvider } from 'vee-validate'
import { required, min, max, email, numeric, confirmed, regex } from 'vee-validate/dist/rules'
import en from 'vee-validate/dist/locale/en.json'

extend( 'min', min)
extend( 'max', max)
extend( 'regex', regex)
extend( 'email', email)
extend( 'numeric', numeric)
extend( 'required', required)
extend( 'confirmed', confirmed)

localize({ en })

Vue.component('validation-provider', ValidationProvider)
Vue.component('validation-observer', ValidationObserver)

/*extend( 'min', { 
	...min,
	message: 'This {_field_} must be {length}characters or less'
})
extend( 'max', { 
	...max,
	message: 'This {_field_} must be '
})
extend( 'regex', { 
	...regex,
	message: 'This {_field_} must be '
})
extend( 'email', { 
	...email,
	message: 'This {_field_} must be a valid email'
})
extend( 'numeric', { 
	...numeric,
	message: 'This {_field_} must be '
})
extend( 'required', { 
	...required,
	message: 'This {_field_} is required je je'
})
extend( 'confirmed', { 
	...confirmed,
	message: 'This {_field_} must be '
})
extend( 'date', { 
	validate: value => 
		/^(19|20)\d\d[/]
		([1-9]|0[1-9]|1[012])[/]
		([1-9]|0[1-9]|1[12][0-9]|3[01])$/.test(
			value
	),
	message: 'Date must be in YYYY/MM/DD format'
})*/