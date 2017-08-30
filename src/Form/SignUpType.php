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

    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\EmailType;
    use Symfony\Component\Form\Extension\Core\Type\PasswordType;
    use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\Validator\Constraints\Email;
    use Symfony\Component\Validator\Constraints\Length;
    use Symfony\Component\Validator\Constraints\NotBlank;

    /**
     * Class SignUpType
     *
     * @author Nicolas GILLE
     * @package Notepad\Form
     * @since 1.0
     * @version 1.0
     */
    class SignUpType extends AbstractType {

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
                    'username',
                    TextType::class,
                    array(
                        'required' => true,
                        'constraints' => array(
                            new NotBlank(),
                            new Length(
                                array(
                                    'min' => 5,
                                    'max' => 50,
                                )
                            ),
                        ),
                    )
                )
                ->add(
                    'password',
                    RepeatedType::class,
                    array(
                        'type' => PasswordType::class,
                        'first_options' => array('label' => 'Password'),
                        'second_options' => array('label' => 'Repeat Password'),
                        'required' => true,
                        'constraints' => array(
                            new Length(
                                array(
                                    'min' => 5,
                                    'max' => 255,
                                )
                            ),
                        ),
                    )
                )
                ->add(
                    'email',
                    EmailType::class,
                    array(
                        'required' => true,
                        'constraints' => array(
                            new NotBlank(),
                            new Email(
                                array(
                                    'checkMX' => true,
                                    'checkHost' => true,
                                )
                            ),
                        ),
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
            return 'sign_up';
        }
    }
