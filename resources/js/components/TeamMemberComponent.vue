<template>
    <div
        class="w-full sm:w-1/2 xl:w-1/3 mb-4"
    >

        <div 
            class="bg-white mx-3 my-2 shadow-lg rounded-lg overflow-hidden h-full"
        >
            <div 
                class="sm:flex sm:items-center px-6 py-4"
            >
                <a 
                    :href="teamworkUrl"
                    target="_blank"
                    class="block mx-auto"
                >
                    <img 
                        class="h-16 sm:h-24 rounded-full sm:mb-0 sm:mr-4 sm:ml-0"
                        v-if="memberData['avatar-url']"
                        :src="memberData['avatar-url']" 
                        :alt="member['first-name']"
                    />
                </a>
                <div 
                    class="text-center sm:text-left sm:flex-grow"
                >
                    <div 
                        class="mb-4"
                    >
                        <p 
                            class="text-xl leading-tight"
                        >
                            {{ member['first-name'] }} {{ member['last-name'] }}
                        </p>
                        <p 
                            class="text-sm leading-tight text-grey-dark"
                        >
                            {{ member['email-address'] }}
                        </p>
                    </div>
                    <div>
                        <a 
                            :href="teamworkMemberUrl"
                            target="_blank"
                            class="text-xs font-semibold rounded-full px-4 py-1 leading-normal bg-white border border-blue text-blue hover:bg-blue hover:text-white no-underline"
                        >
                            View Tasks
                        </a>
                    </div>
                </div>
            </div>

            <div
                class="overflow-hidden"
            >
                <div 
                    class="shadow w-full bg-grey-light"
                >
                    <div 
                        :class="capacityBarClasses"
                        :style="capacityBarStyle"
                    >
                        {{capacity}}%
                    </div>
                </div>

                <p
                    class="my-1 text-right mx-4"
                >
                    {{ totalHours }} assigned of 36 available hours
                </p>                
            </div>

            <div
                class="mx-6 px-6 py-4"
            >
                <div
                    class="mb-2"
                >
                        <div
                            v-for="project in projects"
                            :key="project.id"
                            class="my-4"
                        >
                            <p
                                class="my-1"
                            >
                                <a 
                                    :href="project.link"
                                    class="text-blue no-underline"
                                    target="_blank"
                                >
                                    {{ project.name }}
                                </a>
                            </p>
                            <p
                                class="my-1 text-sm text-grey-dark"
                            >
                                {{ project.completed }}/{{ project.total }} hours completed
                            </p>

                            <!-- <button
                                class="text-right"
                                @click="toggleShowTasks(project)"
                            >
                                Show Tasks
                            </button>

                            <ul v-if="project.showTasks">
                                <li
                                    v-for="task in project.tasks"
                                    :key="task.id"
                                >
                                    {{ task.content }}
                                </li>
                            </ul> -->

                            <div
                                class="overflow-hidden"
                            >
                                <div 
                                    class="shadow w-full bg-grey-light"
                                >
                                    <div 
                                        :class="project.capacityBarClasses"
                                        :style="project.capacityBarStyle"
                                    >
                                        {{project.capacity}}%
                                    </div>
                                </div>
                            </div>
                        </div>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'member',
        ],
        data: function () {
            return {
                memberData: [],
                tasks: [],
                teamworkUrl: document.head.querySelector('meta[name="teamwork-url"]').content,
                teamworkMemberUrl: '',
            }
        },
        mounted() {
            this.fetchData();
            setInterval(() => {
                this.fetchData();
            }, 30000);
        },
        computed: {
            projects: function () {
                return this.tasks.map(function(item, i){
                    return item['project-name'];
                })
                .filter(this.onlyUnique)
                .sort()
                .map((project, i) => {
                    return this.getProjectData(project);
                });
            },
            capacity: function() {
                return Math.round((this.member.estimatedMinutes / 60) / 36 * 100);
            },
            capacityBarStyle: function() {
                return `width: ${this.capacity}%`;
            },
            capacityBarClasses: function() {
                const bg = this.capacity > 90 ? 'bg-red' : this.capacity > 80 ? 'bg-orange' : 'bg-blue';
                return `${bg} text-xs leading-none py-1 text-center text-white`;
            },
            totalHours: function() {
                if(!this.tasks.length){
                    return 0;
                }
                return Math.round( this.tasks.map(function(item,i){
                    return +item['estimated-minutes'];
                }).reduce(function(total, item){
                    return total + item;
                }) / 60 );
            }
        },
        methods: {
            fetchData: function() {
                this.getMemberData()
                    .then((data) => {
                        this.memberData = data.person;
                        this.teamworkMemberUrl = `${this.teamworkUrl}/#people/${this.memberData.id}/tasks`;
                    })
                    .then((data) => {
                        this.getMemberTasks()
                            .then((data) => {
                                this.tasks = data;
                            })
                    });
            },
            getMemberData: function () {
                return fetch(`/api/user/${this.member.id}`)
                    .then((response) => {
                        return response.json();
                    });
            },
            getMemberTasks: function () {
                return fetch(`/api/user-tasks/${this.member.id}`)
                    .then((response) => {
                        return response.json();
                    });
            },
            onlyUnique: function(value, index, self) { 
                return self.indexOf(value) === index;
            },
            getProjectData: function(project){
                const tasks = this.tasks.filter(function(task, i){
                    return task['project-name'] == project;
                });
                const total = Math.round( tasks.map(function(item,i){
                    return +item['estimated-minutes'];
                }).reduce(function(total, item){
                    return total + item;
                }) / 60 );
                const completed = Math.round( tasks.map(function(item,i){
                    if (item['status'] != 'completed') {
                        return 0;
                    }
                    return +item['estimated-minutes'];
                }).reduce(function(total, item){
                    return total + item;
                }) / 60 );
                const percentComplete = Math.round(
                    completed / total * 100
                );

                const bgColor = percentComplete >= 100 ? 'bg-green' : 'bg-blue';

                return {
                    'name': project,
                    'tasks': tasks,
                    total,
                    completed,
                    capacityBarStyle: `width: ${percentComplete}%`,
                    capacity: percentComplete,
                    capacityBarClasses: `${bgColor} text-xs leading-none py-1 text-center text-white`,
                    remaining: total - completed,
                    link: `${this.teamworkUrl}/#projects/${tasks[0]['project-id']}/tasks`
                };
            }
        }
    }
</script>
