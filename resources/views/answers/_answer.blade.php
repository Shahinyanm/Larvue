<answer :answer="{{$answer}}" inline-template>
    <div class="media post">
        @include('shared._vote_control',[
        'model'=>$answer])

        <div class="media-body">
            <form v-if="editing" @submit.prevent="update">
                <textarea v-model="body" rows="10" class="form-control" required></textarea>
                <button type="submit" class="btn btn-primary"  :disabled="isInvalid">Update</button>
                <button @click="cancel" class="btn btn-outline-dark">Cancel</button>
            </form>
            <div v-else>
                <div v-html="bodyHtml"></div>
                <div class="row">
                    <div class="col-4">
                        <div class="ml-auto">
                            @can('update',$answer)
                                <a @click.prevent="edit"
                                   class="btn btn-sm btn-outline-info">Edit</a>
                            @endcan
                            @can('delete',$answer)
                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                            @click="destroy"
                                    >Delete</button>
                                    <form action="{{route('questions.answers.destroy',[$question->id,$answer->id])}}"
                                      method="POST" class="form-delete">
                                </form>
                            @endcan
                        </div>
                    </div>
                    <div class="col-4"></div>

                    <div class="col-4">
                        <user-info :model="{{$answer}}" label="Answered"></user-info>
                    </div>
                </div>
            </div>
        </div>
    </div>
</answer>