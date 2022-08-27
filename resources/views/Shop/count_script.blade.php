<script>
                              $(document).ready( function () {
                                                                          $('#notification_telecaller').show();
                                        $('#notification_shop').hide();
                                        $('#notification_apporder').hide();

                                   $.ajax({
                                type:"GET",
                                dataType: "json",

                                url: '{{route('lastid')}}',
                                success : function(data) {
                                    if(data.teleorder>0)
                                    {
                                        $('#notification_shop').show();
                                    const $bell = document.getElementById('notification_shop');
                                    const count = data.teleorder;
                                    $bell.setAttribute('data-count', count);
                                    $bell.classList.add('show-count');
                                    $bell.classList.add('notify');
                                    } 

                                     if(data.apporder>0)
                                    {
                                        $('#notification_apporder').show();
                                    const $bell = document.getElementById('notification_apporder');
                                    const count = data.apporder;
                                    $bell.setAttribute('data-count', count);
                                    $bell.classList.add('show-count');
                                    $bell.classList.add('notify');
                                    }                                 

                                  }
                                });
                              })
</script>