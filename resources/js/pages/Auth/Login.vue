<script setup>
import {Link} from '@inertiajs/vue3';
</script>

<template>
  <h1 class="text-h4 font-weight-black mb-2">Login</h1>

  <div class="d-flex align-center justify-space-between text-body-1 text-sm-h6 font-weight-regular mb-8">
    Don't have an account yet?
    <Link href="/register" class="text-none">
      <v-btn
          variant="plain"
          class="px-0 opacity-100 text-none"
          text="Sign Up"
          color="primary"
      >
        Sign Up
      </v-btn>
    </Link>
  </div>

  <div>
    <v-label class="font-weight-bold" text="Email Address"/>
    <v-text-field density="comfortable" variant="outlined" placeholder="you@example.com" color="primary"/>
  </div>

  <div>
    <v-label class="font-weight-bold" text="Password"/>
    <v-text-field density="comfortable" variant="outlined" placeholder="Enter your password" persistent-counter
                  color="primary">
      <template v-slot:counter>
        <v-btn color="primary" variant="text" size="small" class="text-body-2 px-0 me-n8">
          Forgot Password?
        </v-btn>
      </template>
    </v-text-field>
  </div>

  <div class="mb-6">
    <v-checkbox-btn class="ms-n3" label="Remember me" color="primary"/>
  </div>

  <v-btn block flat class="text-none text-uppercase" color="surface-variant" rounded="lg" slim variant="elevated"
         height="56"
         text="Login"/>

  <v-divider class="my-8">
    <div class="text-no-wrap text-grey">Or continue with</div>
  </v-divider>

  <div class="d-flex ga-2 ga-md-4">
    <v-btn
        flat
        rounded="lg"
        variant="outlined"
        color="error"
        class="text-body-1 flex-grow-1"
        height="56" width="50"
        text="Google"
        prepend-icon="mdi-google"
    />
  </div>
</template>

