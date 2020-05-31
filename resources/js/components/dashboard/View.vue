<template>
	<v-content>
		<router-view />

		<dashboard-core-footer />
	</v-content>
</template>

<script>
	import DashboardCoreFooter from './Footer'

	export default {
		components: {
			DashboardCoreFooter
		}
	}
</script>