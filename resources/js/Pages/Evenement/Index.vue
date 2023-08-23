<script setup>
    import Layout from "@/Layouts/Layout.vue";
    import { Head } from '@inertiajs/vue3';
    import {Qalendar} from "qalendar";
    import "qalendar/dist/style.css"

   const props = defineProps({
      evenements: Object
   })

  var evts= []

    var config = {
      defaultMode: 'month',
    }

  props.evenements.forEach(e => {
    evts.push({
          title: e.libelle,
          with: e.name + ' ' + e.prenom,
          time: { 
         start: e.date_evenement.slice(0, e.date_evenement.length - 3), 
            end: e.date_evenement.slice(0, e.date_evenement.length - 3)
          },
          color:'yellow',
          isEditable: true,
          id: ""+e.id+"",
          disableDnD: ['month', 'week', 'day'],
          disableResize: ['week', 'day']
        })
  });
</script>

<template>
    <Head title="Calendrier des évènements"></Head>
    <Layout>
      <!-- <ProCalendar
        :events="evts"
        :loading="false"
        view="week"
        @calendarClosed="void"
        />
       -->
       <v-sheet style="height: 800px; border-radius: 10px;">
        <Qalendar :events="evts" :config="config"/>
       </v-sheet>
    </Layout>
</template>