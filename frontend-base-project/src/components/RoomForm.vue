<template>
  <dialog ref="dialog" class="bg-white p-6 rounded-lg">
    <form @submit.prevent="submitForm" class="space-y-4">
      <h2 class="text-2xl mb-4">Add New Room</h2>

      <div>
        <label for="room_number" class="block text-lg">Room Number:</label>
        <input
          id="room_number"
          v-model="formData.room_number"
          type="number"
          required
          class="border-2 border-gray-300 rounded-md w-full p-2"
        />
      </div>

      <div>
        <label for="floor_number" class="block text-lg">Floor Number:</label>
        <input
          id="floor_number"
          v-model="formData.floor_number"
          type="number"
          required
          class="border-2 border-gray-300 rounded-md w-full p-2"
        />
      </div>

      <div>
        <label for="capacity" class="block text-lg">Capacity:</label>
        <input
          id="capacity"
          v-model.number="formData.capacity"
          type="number"
          required
          min="1"
          class="border-2 border-gray-300 rounded-md w-full p-2"
        />
      </div>

      <div>
        <label for="status" class="block text-lg">Status:</label>
        <select
          id="status"
          v-model="formData.status"
          required
          class="border-2 border-gray-300 rounded-md w-full p-2"
        >
          <option value="READY">Ready</option>
          <option value="MAINTENANCE">Maintenance</option>
          <option value="TAKEN">Taken</option>
        </select>
      </div>

      <div class="flex justify-end space-x-4 mt-6">
        <button
          type="button"
          @click="closeDialog"
          class="bg-gray-500 text-white px-4 py-2 rounded-md"
        >
          Cancel
        </button>
        <button
          type="submit"
          class="bg-red-700 text-white px-4 py-2 rounded-md"
        >
          Add Room
        </button>
      </div>
    </form>
  </dialog>
</template>

<script lang="ts">
import { defineComponent, ref } from 'vue';

export default defineComponent({
  emits: ['submit'],
  setup(_, { emit }) {
    const dialog = ref<HTMLDialogElement | null>(null);

    const formData = ref({
      name: '',
      capacity: 1,
      status: 'READY',
    });

    const openDialog = () => {
      dialog.value?.showModal();
    };

    const closeDialog = () => {
      dialog.value?.close();
    };

    const submitForm = () => {
      emit('submit', formData.value);
      closeDialog();
    };

    return {
      dialog,
      formData,
      openDialog,
      closeDialog,
      submitForm,
    };
  },
});
</script>

<style scoped>
dialog[open] {
  display: flex;
  justify-content: center;
  align-items: center;
}
</style>
