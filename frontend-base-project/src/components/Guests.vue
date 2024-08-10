<template>
  <div class="mt-12">
    <h2 class="text-3xl mb-4">Guests</h2>
    <button @click="openGuestForm" class="bg-red-700 px-4 py-2 mb-6">
      Add new Guest
    </button>

    <GuestForm
      ref="guestForm"
      :availableRooms="rooms"
      @submit="addGuest"
    ></GuestForm>

    <div class="flex space-x-4">
      <div
        v-for="guest in guests"
        :key="guest.id"
        class="bg-gray-100 text-black p-4 rounded-md w-1/3"
      >
        <h3 class="text-xl mb-2">{{ guest.name }}</h3>
        <p>{{ guest.room }}</p>
        <div class="flex space-x-2 mt-4">
          <button class="bg-red-700 w-full py-2">Edit</button>
          <button class="bg-red-700 w-full py-2">Delete</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, ref } from 'vue';
import GuestForm from './GuestForm.vue';

export default defineComponent({
  components: {
    GuestForm,
  },
  setup() {
    const rooms = ref<Room[]>([
      { id: 1, name: 'Room #1' },
      { id: 2, name: 'Room #2' },
      { id: 3, name: 'Room #3' },
    ]);

    const guests = ref<Guest[]>([
      { id: 1, name: 'Mo Ku', room: 'Room #3' },
      { id: 2, name: 'John Doe', room: 'Room #1' },
    ]);

    const guestForm = ref<InstanceType<typeof GuestForm> | null>(null);

    const openGuestForm = () => {
      guestForm.value?.openDialog();
    };

    const addGuest = (newGuest: { name: string; room: string }) => {
      const id = guests.value.length + 1;
      guests.value.push({ id, ...newGuest });
    };

    return {
      rooms,
      guests,
      guestForm,
      openGuestForm,
      addGuest,
    };
  },
});
</script>
