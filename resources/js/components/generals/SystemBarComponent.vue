<template>
    <v-system-bar color="primary" lights-out window dark>
        <v-icon>mdi-message</v-icon>
        <span>10 unread messages</span>
        <v-spacer></v-spacer>
        <v-icon>mdi-wifi-strength-4</v-icon>
        <v-icon>mdi-signal-cellular-outline</v-icon>
        <v-icon>mdi-battery</v-icon>
        <span>12:30</span>
    </v-system-bar>
</template>

<style scoped>
    .v-system-bar {
        z-index: 1;
    }
</style>