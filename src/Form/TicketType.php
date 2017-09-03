<?php
    /**
     * Notepad.
     * Copyright (C) 2017 Nicolas GILLE
     *
     * This program is free software: you can redistribute it and/or modify
     * it under the terms of the GNU General Public License as published by
     * the Free Software Foundation, either version 3 of the License, or
     * (at your option) any later version.
     *
     * This program is distributed in the hope that it will be useful,
     * but WITHOUT ANY WARRANTY; without even the implied warranty of
     * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
     * GNU General Public License for more details.
     *
     * You should have received a copy of the GNU General Public License
     * along with this program.  If not, see <http://www.gnu.org/licenses/>.
     */

    declare(strict_types=1);

    namespace Notepad\Form;

    use Notepad\Entity\Ticket;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
    use Symfony\Component\Form\Extension\Core\Type\HiddenType;
    use Symfony\Component\Form\Extension\Core\Type\RadioType;
    use Symfony\Component\Form\Extension\Core\Type\TextareaType;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;
    use Symfony\Component\Validator\Constraints\Length;
    use Symfony\Component\Validator\Constraints\NotBlank;

    /**
     * Class TicketType.
     *
     * @author Nicolas GILLE
     * @package Notepad\Form
     * @since 0.1
     * @version 1.0
     */
    class TicketType extends AbstractType {

        /**
         * Build form on twig template.
         *
         * @param \Symfony\Component\Form\FormBuilderInterface $builder
         *  Interface to build form.
         * @param array $options
         *  Options to build form.
         *
         * @since 1.0
         * @version 1.0
         */
        public function buildForm(FormBuilderInterface $builder, array $options) {
            $builder
                ->add(
                    'title',
                    TextType::class,
                    array(
                        'required' => true,
                        'constraints' => array(
                            new NotBlank(),
                            new Length(
                                array(
                                    'min' => 1,
                                    'max' => 255,
                                )
                            ),
                        ),
                    )
                )
                ->add(
                    'content',
                    TextareaType::class,
                    array(
                        'required' => true,
                        'constraints' => array(
                            new NotBlank(),
                        ),
                        'attr' => array(
                            'cols' => 50,
                            'rows' => 10,
                        ),
                    )
                )
                ->add(
                    'label',
                    LabelType::class
                )->add(
                    'isArchive',
                    ChoiceType::class,
                    array(
                        'expanded' => true,
                        'choices' => array (
                            'Yes' => true,
                            'No' => false,
                        ),
                    )
                );
        }

        /**
         * Configure option for form.
         *
         * @param \Symfony\Component\OptionsResolver\OptionsResolver $resolver
         *
         * @since 0.1
         * @version 1.0
         */
        public function configureOptions(OptionsResolver $resolver) {
            $resolver->setDefaults(
                array(
                    'data_class' => Ticket::class,
                )
            );
        }

        /**
         * Return the name of the form object.
         *
         * @return string
         *  The name of form object.
         * @since 1.0
         * @version 1.0
         */
        public function getName(): string {
            return 'ticket_form';
        }
    }
